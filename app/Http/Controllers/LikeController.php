<?php

namespace App\Http\Controllers;

use Request;
use App\Http\Requests;
use App\Like;

class LikeController extends Controller
{
    public function index()
    {
    	$post_id=Request::get('post_id');
    	$is_liked=Like::IP(Request::ip())->PostId($post_id)->first();
    	$message='failed';
    	if (!$is_liked) {
    		Like::create(['ip'=>Request::ip(),'post_id'=>$post_id]);
    		$message='success';
    	}
    	$total_likes=Like::PostId($post_id)->get()->count();
        return response()->json([
            'message' => $message,
            'like'    => $total_likes
        ]);
    }
}
