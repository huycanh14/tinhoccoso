<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post_category extends Model
{
    protected $table = 'post_categories';

    public function post()
    {
    	return $this->hasMany('App\Post', 'post_category_id', 'id');
    }

    public function comment()
    {
    	retun $this->hasManyThrough('App\Comment', 'App\Post', 'post_id', 'post_category_id', 'id');
    }
}
