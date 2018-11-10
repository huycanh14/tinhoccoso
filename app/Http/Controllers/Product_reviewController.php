<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Product_review;

class Product_reviewController extends Controller
{
    public function index($id)
    {
    	//$product_review = Product_review::join('customers', 'product_reviews.user_id', '=', 'customers.id')
    	$product = Product::find($id);
    	$product_reviews = Product_review::where('product_id', '=', $id)->get();
    	$data = [
    		'product_reviews' => $product_reviews,
    		'product' => $product
    	];
    	return view('admin.product_review.index', $data);
    }
}
