<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelFakeId\FakeIdTrait;
class Video extends Model
{
	use FakeIdTrait;
    protected $table="videos";

	protected $appends = ['fake_id'];

    public function getFakeIdAttribute() {
        return $this->getRouteKey();
    }
    
    public function post()
    {
    	return $this->belongsTo("App\Post");
    }
    public function reports()
    {
        return $this->hasMany("App\Report");
    }
    
}
