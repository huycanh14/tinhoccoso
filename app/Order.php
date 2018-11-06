<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = "orders";

    public function order_item()
    {
    	return $this->hasMany('App\Order_item', 'order_id', 'id');
    }

    public function customer()
    {
    	return $this->belongsTo('App\Customer', 'customer_id', 'id');
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
