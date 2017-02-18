<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    /**
	* table name
	*/
	protected $table='likes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip', 'post_id',
    ];
    /**
    *
    */
    public function scopeIP($query,$ip)
    {
        return $query->where('ip', '=', $ip);
    }
    /**
    *
    */
    public function scopePostId($query,$post_id)
    {
        return $query->where('post_id', '=', $post_id);
    }
}
