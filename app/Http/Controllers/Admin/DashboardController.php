<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;

class DashboardController extends Controller
{
    


    public function getDashboadPage()
    {
    	$all_v= Post::count();
    	$view = Post::sum("view_count");
    	$banned = Post::where('types','=','unpublished')
    	->count();
    	return view("admin.index")->withDash(['totalVid'=>$all_v,'totalView'=>$view,'banned'=>$banned]);
    }
}
