<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;
use App\Video;
use Carbon\Carbon;
use Redirect;
use Session;
use URL;
class PostController extends Controller
{
    public function __construct()
    {
        //Session::put('url.intended',URL::previous());    
    }

    public function getHomePage()
    {
    	$date = new Carbon; //  DateTime string will be 2014-04-03 13:57:34
		$date->subWeek();

    	$last = Post::where('created_at','>',$date->toDateTimeString() )
    	->where('types','=','published')
    	->take(10)
        ->orderBy('created_at',"desc")
    	->get();
    	$top = Post::where('types','=','published')
    	->orderBy('view_count',"desc")
    	->take(10)
    	->get();

        return view("posts.index")->withPosts(['lasts'=>$last,'top'=>$top]);
    }
    public function getVideoPage($id)
    {
    	$post = Post::where('id','=',$id->id)
    	->where('types','=','published')
    	->first();

    	if($post==null)
    	{
    		return redirect()->route('posts.index');
    	}
        $tages = [];
        $txt =$post->tages;
        preg_match_all('/\w+/', $txt,$tages);
        
    	$suggest = Post::where(function($query) use ($tages){
            foreach ($tages[0] as $tage) {
                $query->orwhere('tages','like',"%{$tage}%");
            }
        })
    	->where('types','=','published')
    	->where('id','<>',$post->id)
        ->inRandomOrder()
    	->take(20)
        ->get();

        return view("posts.watch")->withPosts(['post'=>$post,'suggests'=>$suggest]);
    }

    public function getSearchPage(Request $req)
    {
        $q = $req->input("q");
        if(!$q)
        {
            return Redirect::to(Session::get('url.intended'));
        }
        $qu = Post::query();
        $qu->search($q);         
        $rs = $qu->paginate(20);
        return view("posts.search")->withPosts($rs);
    }
}
