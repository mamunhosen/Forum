<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Comment;

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
      $check=Post::findOrFail($post_id);
      $post=Post::with('user','category','likes')->ID($post_id)->first();
      $comments=Comment::with('user')->ID($post_id)->get();
      return view('site.home.fullview',compact('post','comments'));
      
    }
}
