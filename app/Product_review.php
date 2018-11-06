<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_review extends Model
{
    protected $table = 'product_reviews';

    public function product()
    {
    	return $this->belongsTo('App\Product', 'product_id', 'id');
    }

    public function customer()
    {
    	return $this->belongsTo('App\Customer', 'customer_id', 'id');
    }
}
