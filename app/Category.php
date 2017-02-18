<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
	* table name
	*/
	protected $table='categories';
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description','status',
    ];
    /**
    *
    */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

}
