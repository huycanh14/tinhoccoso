<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    public function product_image()
    {
    	return $this->hasMany('App\Product_image', 'product_id', 'id');
    }

    public function product_relate()
    {
    	return $this->hasMany('App\Product_relate', 'product_id', 'id');
    }

    public function product_review()
    {
    	return $this->hasMany('App\Product_review', 'product_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasMany('App\Order_item', 'product_id', 'id');
    }

    public function product_category()
    {
    	return $this->belongsTo('App\Product_category', 'product_category_id', 'id');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Brand', 'brand_id', 'id');
    }
}
