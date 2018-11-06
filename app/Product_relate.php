<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_relate extends Model
{
    protected $table = 'product_relates';

    public function product()
    {
    	return $this->hasMany('App\Product', 'product_id', 'id');
    }
}
