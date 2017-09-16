<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\ReportVidRequest;
use App\Report;

/**
*
*For Guest Report to A Video
*/
class ReportVidController extends Controller
{
    //

	public function store(ReportVidRequest $request,$id)
	{

		$checkReport = Report::where("video_id",$id)
		->where("ip",$request->ip())
		->orderBy("created_at","desc")
		->first();
		
		$delay_report =strtotime(date("Y-m-d H:i:s")) - strtotime($checkReport->created_at->format('Y-m-d H:i:s'));// ;
		if($delay_report<60)//delay 1minute
		{
			return ['Wait 1 minute to report again'];
		}
		if($checkReport->ip)
		{
			return ['Report already'];
		}
		$rep = new Report();
		$rep->rep_types = $request->types;
		$rep->message = $request->message;
		$rep->ip = $request->ip();
		$rep->agent = $request->header('User-Agent');
		$rep->video_id = $id;
		$rep->save();
		return ["ok"];
	}
}
