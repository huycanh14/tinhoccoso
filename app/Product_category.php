<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_category extends Model
{
    protected $table = "product_categories"; //thương hiệu sản phẩm
    // public $timestamps = true; 
    // const UPDATED_AT = null;
    // const CREATED_AT = 'creation_date';
// const UPDATED_AT = 'creation_date';

    public function product()
    {
    	return $this->hasMany('App\Product', 'product_category_id', 'id');
    }

    public function product_image()
    {
    	return $this->hasManyThrough('App\Product_image', 'App\Product', 'product_id', 'product_category_id', 'id');
    }

    public function product_relate()
    {
    	return $this->hasManyThrough('App\Product_relate', 'App\Product', 'product_id', 'product_category_id', 'id');
    }

    public function product_review()
    {
    	return $this->hasManyThrough('App\Product_review', 'App\Product', 'product_id', 'product_category_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasManyThrough('App\Order_item', 'App\Product', 'product_id', 'product_category_id', 'id');
    }
}
