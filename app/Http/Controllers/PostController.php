<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Validator;
use Redirect;
use Auth;
use App\Post;

class PostController extends Controller
{
	/**
    * new blog page.
	*/
    public function index()
    {
    	$category=Category::all();
    	//dd($category->toArray());
    	return view('site.blog.index',compact('category'));
    }
    /**
    *Incoming request for post blog
    */
    public function store(Request $request)
    {
        $validator=$this->validator($request->all());
        //dd($validator->messages());
        if($validator->fails()){
           return Redirect::back()->withInput()->withErrors($validator->messages());
        }
          $image = $request->file('image');
          $imageName=explode('.',$image->getClientOriginalName());
          $imageName = time().'_'.$imageName[0].'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/images');
          $data=[
		    'title'=>$request->title,
		    'category_id'=>$request->category_id,
		    'user_id'=>Auth::user()->id,
		    'content' =>$request->content,
		    'image'   =>$imageName,
		    'status'  =>1
         ];
        if(Post::create($data)){
        	$image->move($destinationPath, $imageName);
        	return Redirect::to('/');
        }
    }
    /**
    * Incoming blog post validator
    */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|min:5',
            'category_id' => 'exists:categories,id',
            'content' => 'required|min:20',
            'image'   =>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],['category_id.exists' => 'Please select a Category']);
    }

}
