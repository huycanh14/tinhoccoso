<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // protected $fillable = [
    //     'author',
    //     'name',
    //     'updated_at'
    // ];
	protected $table = "orders";
    //const CREATED_AT = null;
    //public $timestamps = false;
    protected $guarded = [
        'id',
        'created_at'
    ];

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
