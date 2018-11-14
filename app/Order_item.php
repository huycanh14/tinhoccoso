<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $table = "order_items";
    public $timestamps = false;

    public function order()
    {
    	return $this->belongsTo('App\Order', 'order_id', 'id');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
