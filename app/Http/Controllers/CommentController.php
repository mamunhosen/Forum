<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use Auth;
use Validator;
use App\User;

class CommentController extends Controller
{
    public function store(Request $request)
    {
    	$user_id=Auth::user()->id;
    	$post_id=$request->get('post_id');
    	$validator=$this->validator(['comment'=>$request->get('comment')]);
    	if ($validator->fails()) {
    	   return response()->json([
            'message' => $validator->messages()
           ]);
    	}
    	$comment=Comment::create([
    		'user_id' =>$user_id,
    		'post_id' =>$post_id,
    		'content' =>$request->get('comment'),
    		'status'  =>1
    		]);
    	 $total_comments=Comment::ID($post_id)->get()->count();
         return response()->json([
            'message' => 'success',
            'name'    => Auth::user()->name,
            'total_comments' =>$total_comments,
            'content'      =>$comment->content
        ]);
    }
    /**
    * Incoming blog comment validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'comment' => 'required']);
    }
}
