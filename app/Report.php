<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Propaganistas\LaravelFakeId\FakeIdTrait;

class Report extends Model
{
    use FakeIdTrait;
	
	protected $table="reports";

    //protected $appends = ['fake_id'];

    protected $fillable = [ 'message','ip','agent']; 

    /*public function getFakeIdAttribute() {
        return $this->getRouteKey();
    }*/
    public function video()
    {
    	return $this->belongsTo("App\Video");
    }

    

}
