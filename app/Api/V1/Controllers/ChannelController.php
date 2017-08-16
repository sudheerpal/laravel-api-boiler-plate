<?php

namespace App\Api\V1\Controllers;


use Config;
use App\Channel;
use App\Video;

use App\Http\Requests;
use Illuminate\Http\Request;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Dingo\Api\Exception\ValidationHttpException;



class ChannelController extends Controller
{
    
    // public function test(){
    // 	return 'Channel from Controller !!!';
    // }


    public function ChannelDetail($channel_id){

			return DB::table('channels')->where([
			['id', $channel_id]
			])->get();

    }



    public function channelList(){

    	return DB::table('channels')->where([
	    ['is_active', '1'],
	    ['is_deleted', '0']
	    ])->get()->toArray();


    }


    public function channelCreate(Request $request)
    {

        $this->validate($request, [
        'title' => 'required|min:2|max:255',
        'logo' => 'required|min:2|max:255',
        'description' => 'required',
        'is_active' => 'required|boolean',
        'is_deleted' => 'required|boolean',

    ]);

        $channel = new Channel;
        $channel->title = trim($request->get('title')) ;
        $channel->logo = trim($request->get('logo')) ;
        $channel->description = trim($request->get('description')) ;
        $channel->is_active = trim($request->get('is_active')) ;
        $channel->is_deleted = trim($request->get('is_deleted')) ; 

        

        if($channel->save())
            return response()->json([
                'status' => 'ok',
                'channel_id' => $channel->id,
                'message' => 'Channel created successfully'
                ], 201);

        else
            return response()->json([
                'status' => 'error',
                'message' => 'could not create Channel'
                ], 500);
    }


}
