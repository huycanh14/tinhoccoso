<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer_group extends Model
{
	protected $table = "customer_groups";
	
    public function customer()
    {
    	return $this->hasMany('App\Customer', 'customer_group_id', 'id');
    }

    public function comment()
    {
    	return $this->hasManyThrough('App\Comment', 'App\Customer', 'customer_id', 'customer_group_id', 'id');
    }

	public function product_relate()
    {
    	return $this->hasManyThrough('App\Product_relate', 'App\Customer', 'customer_id', 'customer_group_id', 'id');
    }

    public function order()
    {
    	return $this->hasManyThrough('App\Order', 'App\Customer', 'customer_id', 'customer_group_id', 'id');
    }

    public function order_item()
    {
    	return $this->hasManyThrough('App\Order_item','App\Order', 'App\Customer', 'order_id', 'customer_group_id', 'customer_id', 'id');
    }
}
