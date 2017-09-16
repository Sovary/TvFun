<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\PostVideoRequest;
use App\Http\Controllers\Controller;

use App\Post;
use App\Video;
use Auth;
use DB;
use File;   
use Image;
use Session;
use URL;
use Redirect;
class PostVideoController extends Controller
{
    

    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::orderBy("created_at","desc")->get();

        return view("admin.post.index")->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Post::select("id","tages")->orderBy("tages","asc")->get();
        $str="";
        foreach($tags as $ta)
        {
           $str.= ",".$ta->tages;
        }
        $x = array_filter(array_unique(explode(',', $str)));
        sort($x);
        
        return view("admin.post.create")->withTags($x);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostVideoRequest $request)
    {
        $this->validate($request,[
                'video_url'=>'required|unique:videos,url'
            ]);
        $post = new Post;
        $post->title = mb_convert_case($request->post_title,MB_CASE_TITLE, "UTF-8");
        $post->description = $request->description;
        $post->tages = strtolower($request->tags_1);
        $post->types = $request->post_types;
        $post->highlight = $request->highlight;
        $post->user_id  = Auth::user()->id;
        if($request->thumbnail_types=="default")
        {
            $post->thumbnail = $request->default_thumbnail;
        }else
        {
            $this->validate($request,[
                'post_thumbnail'=>'required|image|mimes:jpeg,png,jpg,gif|max:300'
            ]);
    //save file
            $file = $request->file("post_thumbnail");
            $img_name = time()."_".$file->getClientOriginalName();

            $post->thumbnail = $img_name;

            $img = Image::make($file->getRealPath());
            $img->resize(196,110);
            $img->save('uploads/'.$img_name);
    //end save file
        }
        $post->save();

        $vid = new Video;
        $vid->title = mb_convert_case($request->video_title,MB_CASE_TITLE, "UTF-8");
        $vid->url = $request->video_url;
        $vid->types = $request->video_types;
        $vid->post_id = $post->id;

        $vid->save();
        Session::flash('success','The Post is posted successfully');            

        return redirect()->route("admin.post.create");

        //dd($request);
    }

    public function show($id)
    {
        
    }

    public function edit($post)
    {
        $uid = Auth::user()->id;

        $post=Post::where('id',$post->id)
            ->where('user_id',$uid)->first();
        Session::put('url.intended',URL::previous());    
        if(empty($post))
        {
            Session::flash("custom_err","Permission Denied");
           return redirect()->route('admin.post.index');
        }

        $tags = Post::select("id","tages")->orderBy("tages","asc")->get();
        $str="";
        foreach($tags as $ta)
        {
           $str.= ",".$ta->tages;
        }
        $x = array_filter(array_unique(explode(',', $str)));
        sort($x);

        return view("admin.post.edit")->withPost($post)->withTags($x);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostVideoRequest $request, $post)
    {
        
        $post=Post::find($post->id);

        if($request->thumbnail_types=="default")
        {
            if(File::exists("uploads/".$post->thumbnail) && $post->thumbnail!=""){
                unlink("uploads/".$post->thumbnail);    
            }
            $post->thumbnail = $request->default_thumbnail;
        }else{

            $file = $request->file("post_thumbnail");
            if($file!=null)
            {
                if(File::exists("uploads/".$post->thumbnail) && $post->thumbnail!=""){
                    unlink("uploads/".$post->thumbnail);    
                }
                
                $img_name = time()."_".$file->getClientOriginalName();
                $post->thumbnail = $img_name;
                $img = Image::make($file->getRealPath());
                $img->resize(196,110);
                $img->save('uploads/'.$img_name);
                
            }
        }
        $post->title = mb_convert_case($request->post_title,MB_CASE_TITLE, "UTF-8");
        $post->description = $request->description;
        $post->tages = strtolower($request->tags_1);
        $post->types = $request->post_types;
        $post->highlight = $request->highlight; 

        Session::flash('success','The Post is updated successfully');
        //This will problem when has multiple video in one post
        $vid = Video::find($post->id);
        $vid->title = mb_convert_case($request->video_title,MB_CASE_TITLE, "UTF-8");
        $vid->url = $request->video_url;
        $vid->types = $request->video_types;

        $post->save();
        $vid->save();
        return Redirect::to(Session::get('url.intended'));
        //return redirect()->route("admin.post.index");
    }

    
}
