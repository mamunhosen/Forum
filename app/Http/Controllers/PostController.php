<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Category;
use Validator;
use Redirect;
use Auth;
use App\Post;
use File;
use Session;

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
    /**
    *Post delete
    */
    public function delete($id)
    {
        try {
            $decrypted_id = decrypt($id);
            $post=Post::findOrFail($decrypted_id);
            if (File::exists('public/images/'.$post->image))
             {
              File::delete('public/images/'.$post->image);
             }
            $post->delete();
             return response()->json([
                'message' => 'success',
            ],200);

        } catch (DecryptException $e) {
            return response()->json([
            'message' => 'invalid id'
        ],404);
        }
    }
    /**
    *Post edit
    */
    public function edit($id)
    {
        try {
            $decrypted_id = decrypt($id);
            $row=Post::findOrFail($decrypted_id);
            $category=Category::all();
            return view('site.blog.edit',compact('category','row'));
            
        } catch (DecryptException $e) {
            return response()->json([
            'message' => 'invalid id'
        ],404);
        }
      
    }
    /**
    *Post Update
    */
    public function update(Request $request){
        $validator=$this->u_validator($request->all());
        if($validator->fails()){
           return Redirect::back()->withInput()->withErrors($validator->messages());
        }
        $post=Post::findOrFail($request->post_id);
        if ($request->file('image')) {
          $image = $request->file('image');
          $imageName=explode('.',$image->getClientOriginalName());
          $imageName = time().'_'.$imageName[0].'.'.$image->getClientOriginalExtension();
          $destinationPath = public_path('/images');
          $post->image=$imageName;
          $image->move($destinationPath, $imageName);
        }
        $post->title=$request->title;
        $post->category_id=$request->category_id;
        $post->content=$request->content;
        if($post->update()){
          //$image->move($destinationPath, $imageName);
          Session::flash('message', 'Post has been updated successfully!'); 
          Session::flash('alert-class', 'alert-success'); 
          return Redirect::to('fullview/'.encrypt($post->id));
        }
    }
    /**
    * Incoming blog update validator
    */
    protected function u_validator(array $data)
    {
        return Validator::make($data, [
            'title' => 'required|min:5',
            'category_id' => 'exists:categories,id',
            'content' => 'required|min:20',
            'image'   =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],['category_id.exists' => 'Please select a Category']);
    }

}
