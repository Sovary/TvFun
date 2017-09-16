<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::auth();

Route::group(['prefix'=>'admin/','namespace'=>'Admin','middleware'=>'auth'],function(){
	
	Route::get("/","DashboardController@getDashboadPage");
	//resource dashboard
	Route::resource("post",'PostVideoController');

});



/*Route::get("/about", function(){
	return view("pages.about");
});*/

Route::get("/",['as'=>'posts.index','uses'=>"PostController@getHomePage"]);

Route::get("/watch/{post}",['as'=>'posts.watch','uses'=>"PostController@getVideoPage"]);

Route::get("/search",['as'=>'posts.search','uses'=>"PostController@getSearchPage"]);

Route::post("/report/{id}/send/",['as'=>'report.send','uses'=>'ReportVidController@store']);

view()->share( 'PATH', "" );