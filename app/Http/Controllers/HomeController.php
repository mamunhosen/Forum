<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Comment;
use Redirect;

class HomeController extends Controller
{
    public function index()
    {
       $rows=Post::with('comments','user','category','likes')->orderBy('updated_at','desc')->paginate(3);
       return view('site.home.home',compact('rows'));
    }
    /**
    *Single post view
    */
    public function fullview($post_id)
    {
        try 
        {
          $decrypt_post_id=decrypt($post_id);//decryption the post id.
          $check=Post::findOrFail($decrypt_post_id);
          $post=Post::with('user','category','likes')->ID($decrypt_post_id)->first();
          $comments=Comment::with('user')->ID($decrypt_post_id)->get();
          return view('site.home.fullview',compact('post','comments'));

        } catch (DecryptException $e) {
          return response()->json([
            'message' => 'invalid ID'
           ],404);

        }
      
    }
}
