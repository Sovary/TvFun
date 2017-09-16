<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelFakeId\FakeIdTrait;

class Post extends Model
{
	use FakeIdTrait;
	
	protected $table="posts";

    protected $appends = ['fake_id'];

    protected $fillable = [ 'title', 'description','tages',"thumbnail","highlight","types",]; 

    public function getFakeIdAttribute() {
        return $this->getRouteKey();
    }


    public function videos()
    {
    	return $this->hasMany("App\Video");
    }
    
    public function user()
    {
    	return $this->belongsTo("App\User");
    }
    public function scopeSearch($query,$txt)
    {
        $searchValues = [];
        if( strpos($txt, '#') !== false )
        {
            preg_match_all('/\#(\w+)/', $txt,$searchValues);
        }
       // $query->whereHas('job_txt', function ($q) use ($txt) {
            $query->select("posts.id","description","view_count","thumbnail","posts.title",'tages','posts.types','posts.created_at')
            //->with('videos')
            ->where(function($query){
                $query->where("posts.types",'published');
            })->where(function($query) use($txt,$searchValues){
                $query->orwhere('posts.title', 'like', "%{$txt}%")
                //->orwhere('posts.description', 'like', "%{$txt}%")
                //->orwhere('videos.title', 'like', "%{$txt}%")
                ->orwhere(function ($q) use ($searchValues){
                    if(count($searchValues)>1){
                        foreach ($searchValues[1] as $tage) {
                            $q->orwhere('tages','like',"%{$tage}%");
                        }
                    }
                });
            })
            ->orderBy("view_count","posts.title","created_at");
        //});
    }
}

