<?php
use App\User;
use App\Post;
use App\Comment;
use App\Category;
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

Route::get('/', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

Route::get('/authentication', [
    'as' => 'auth', 'uses' => 'Auth\AuthController@index'
]);
Route::get('/registration', [
    'as' => 'regis', 'uses' => 'Auth\AuthController@register'
]);
Route::post('/registration', [
    'as' => 'regis_post', 'uses' => 'Auth\AuthController@store'
]);
Route::post('/login', [
    'as' => 'login', 'uses' => 'Auth\AuthController@getAuthenticated'
]);
Route::get('/fullview/{postId}',['as' => 'fullview','uses' =>'HomeController@fullview']);

Route::get('/like',['as'=>'like','uses'=>'LikeController@index']);

/**
* users need to be authenticated to get access following route.
*/
Route::group(['middleware' => 'auth'], function () {
 Route::get('/new_blog', [
    'as' => 'new_blog', 'uses' => 'PostController@index'
]);
 Route::post('/blog_post', [
    'as' => 'blog_post', 'uses' => 'PostController@store'
]);
 Route::post('comment','CommentController@store');
 Route::get('/logout', [
    'as' => 'logout', 'uses' => 'Auth\AuthController@logout'
]);
 Route::put('/comment/{id}',['as'=>'comment.edit','uses'=>'CommentController@edit']);
 Route::delete('/comment/{id}',['as'=>'comment.delete','uses'=>'CommentController@delete']);

});
Route::get('user',function(){
	$data=Post::with('comments','user','category','likes')->get()->toArray();
	dd($data);
	foreach ($data as $key => $val) {
		echo "author name:".User::find($val['user_id'])->name."<br/>";
		echo 'title:'.$val['title']."<br/>";
		echo 'Category Name:'.Category::find($val['cat_id'])->name."<br/>";
		if(count($val['comments'])>0){
			foreach ($val['comments'] as $key => $comment) {
				echo User::find($comment['user_id'])->name.':'.$comment['content'].'<br/>';
			}
		}
	}
});
