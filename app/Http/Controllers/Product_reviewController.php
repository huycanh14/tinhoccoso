<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_image;
use App\Product_review;
use Session;

class Product_reviewController extends Controller
{
    public function index($id)
    {
    	//$product_review = Product_review::join('customers', 'product_reviews.user_id', '=', 'customers.id')
    	$product = Product::find($id);
    	$product_reviews = Product_review::join('customers', 'product_reviews.user_id', '=', 'customers.id')->select('product_reviews.*' ,'customers.fullname as fullname')->where('product_id', '=', $id)->get();
    	$product_image = Product_image::where('product_id', '=', $id)->first();
    	$data = [
    		'product_reviews' => $product_reviews,
    		'product' => $product,
    		'product_image' => $product_image
    	];
    	return view('admin.product_review.index', $data);
    }

    public function update($product_id, $id)
    {
    	$product_review = Product_review::join('customers', 'product_reviews.user_id', '=', 'customers.id')->select('product_reviews.*' ,'customers.*')->where('product_reviews.id', '=', $id)->first();
    	//var_dump($product_review); exit();
    	$product = Product::find($product_id);
    	$data = [
    		'product_review' => $product_review,
    		'product' => $product
    	];
    	return view('admin.product_review.update', $data);
    }

    public function post_update(Request $request, $product_id, $id)
    {
    	//echo(1); exit;
    	$this->validate($request, [
    		'content'=>'required'
    	], [
    		'name.required' => 'Nội dung bạn đang để trống'
    	]);
    	$product_review = Product_review::find($id);
    	$product_review->content = $request->content;
    	$product_review->save();
    	return redirect('admin/product_review/update/' .$product_id .'/'.$id)->with('thongbao', 'Sửa đánh giá thành công');
    }

    public function review(Request $request, $id)
    {
        $this->validate($request, [
            'content'=>'required'
        ], [
            'name.required' => 'Nội dung bạn đang để trống'
        ]);
        $product_review = new Product_review;
        $product_review->product_id = $id;
        $product_review->user_id = Session('user')->id;
        $product_review->content = $request->content;
        $product_review->rate = $request->rate;
        $product_review->save();
        return redirect()->back()->with('thongbao', 'Đánh giá thành công');
    }
}
