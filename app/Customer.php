<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customers";

    public function comment()
    {
    	return $this->hasMany('App\Comment', 'user_id', 'id');
    }

    public function product_relate()
    {
    	return $this->hasMany('App\Product_relate', 'user_id', 'id');
    }

    public function order()
    {
    	return $this->hasMany('App\Order', 'user_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasManyThrough('App\Order_item', 'App\Order', 'order_id', 'user_id', 'id');
    }

    public function customer_group()
    {
    	return $this->belongsTo('App\Customer_group', 'customer_group_id', 'id');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province', 'province_id', 'id');
    }

    public function district()
    {
    	return $this->belongsTo('App\District', 'district_id', 'id');
    }
}
