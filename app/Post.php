<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
	/**
	* table name
	*/
	protected $table='posts';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title','content','image','status',
    ];
    /**
     * Get the user that owns the posts.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * Get the comments for the forum post.
     */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
    /**
    *
    */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    /**
    *
    */
    public function likes()
    {
    	return $this->hasMany('App\Like');
    }
    /**
    *
    */
    public function scopeID($query,$post_id)
    {
        return $query->where('id', '=', $post_id);
    }
}
