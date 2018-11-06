<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function comment()
    {
    	return $this->hasMany('App\Comment', 'post_id', 'id');
    }

    public function post_category()
    {
    	return $this->belongsTo('App\Post_category', 'post_category_id', 'id');
    }
}
