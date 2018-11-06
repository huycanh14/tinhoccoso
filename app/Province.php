<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';

    public function customer()
    {
    	return $this->hasMany('App\Customer', 'district_id', 'id');
    }

    public function comment()
    {
    	return $this->hasManyThrough('App\Comment', 'App\Customer', 'customer_id', 'district_id', 'id');
    }

	public function product_relate()
    {
    	return $this->hasManyThrough('App\Product_relate', 'App\Customer', 'customer_id', 'district_id', 'id');
    }

    public function order()
    {
    	return $this->hasManyThrough('App\Order', 'App\Customer', 'customer_id', 'district_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasManyThrough('App\Order_item','App\Order', 'App\Customer', 'order_id', 'district_id', 'customer_id', 'id');
    }

    public function district()
    {
    	return $this->belongsTo('App\District', 'district_id', 'id');
    }
}
