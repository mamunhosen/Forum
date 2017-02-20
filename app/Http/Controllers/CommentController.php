<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Comment;
use Auth;
use Validator;
use App\User;
use Illuminate\Contracts\Encryption\DecryptException;
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
         $encrypted_id=encrypt($comment->id);
         return response()->json([
            'message' => 'success',
            'name'    => Auth::user()->name,
            'total_comments' =>$total_comments,
            'token' =>csrf_token(),
            'comment_id' =>$comment->id,
            'action_url'=>url('comment/'.$encrypted_id),
            'encrypted_comment_id' =>encrypt($comment->id),
            'content'      =>$comment->content
        ]);
    }
    public function edit(Request $request,$id){

            try {
            $decrypted_id = decrypt($id);
            $comment=Comment::findOrFail($decrypted_id);
            $comment->content=$request->comment;
            $comment->update();
             return response()->json([
                'message' => 'success',
                'id'=>$decrypted_id
            ],200);

        } catch (DecryptException $e) {
            return response()->json([
            'message' => 'invalid id'
        ],404);
        }
    }
    public function delete($id){

        try {
            $decrypted_id = decrypt($id);
            $comment=Comment::findOrFail($decrypted_id);
            $comment->delete();
             return response()->json([
                'message' => 'success',
                'id'=>$decrypted_id
            ],200);

        } catch (DecryptException $e) {
            return response()->json([
            'message' => 'invalid id'
        ],404);
        }
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
