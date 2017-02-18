<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    /**
     * Get all posts for the user.
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
    /**
    * Get all comments for the user
    */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
