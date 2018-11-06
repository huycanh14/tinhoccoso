<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands"; //thương hiệu sản phẩm

    public function product()
    {
    	return $this->hasMany('App\Product', 'brand_id', 'id');
    }

    public function product_image()
    {
    	return $this->hasManyThrough('App\Product_image', 'App\Product', 'product_id', 'brand_id', 'id');
    }

    public function product_relate()
    {
    	return $this->hasManyThrough('App\Product_relate', 'App\Product', 'product_id', 'brand_id', 'id');
    }

    public function product_review()
    {
    	return $this->hasManyThrough('App\Product_review', 'App\Product', 'product_id', 'brand_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasManyThrough('App\Order_item', 'App\Product', 'product_id', 'brand_id', 'id');
    }
}
