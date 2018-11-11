<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_item;
use App\District;
use App\Province;
use App\Product;

class Order_itemController extends Controller
{
    public function index($order_id)
    {
    	$order_item = Order_item::where('order_id', $order_id)->get();
    	$order = Order::find($order_id);
    	$data = [
    		'order_item' => $order_item,
    		'order' => $order
    	];
    	return view('admin.order_item.index', $data);
    }
}
