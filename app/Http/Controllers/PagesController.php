<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_category;
use App\Product_image;
use App\Product_review;
use App\Banner;
use App\Brand;
use App\Cart;
use Session;
use App\District;
use App\Province;

class PagesController extends Controller
{
    public function index()
    {
    	$banner = Banner::all();
    	$product_new = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where('products.is_new', '=', '1')->orderBy('id', 'DESC')->paginate(8, ['*'], 'san-pham-moi-page');
    	$product_sale = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where('products.is_sale', '=', '1')->orderBy('id', 'DESC')->paginate(8, ['*'], 'san-pham-moi-page');
    	$data = [
    		'banner' => $banner,
    		'product_new' => $product_new,
    		'product_sale' => $product_sale
    	];

    	return view('pages.trangchu', $data);
    }

    public function loai_sanpham($id)
    {
    	$product_category = Product_category::find($id);
    	$product_new = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['product_category_id', '=', $id],
    		['is_new', '=', '1']
    	])->orderBy('id', 'DESC')->paginate(3, ['*'],  $product_category->slug . '-moi-page');
        $products = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['product_category_id', '=', $id]
    	])->orderBy('id', 'DESC')->paginate(6, ['*'],  $product_category->slug . '-page');
    	
    	$data = [
    		'products' => $products, 
    		'product_new' => $product_new,
    		'loai_sanpham' => $product_category
    	];
    	return view('pages.loai_sanpham', $data);
    }

    public function thuonghieu_sanpham($id)
    {
    	$brand = Brand::find($id);
    	$product_new = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['brand_id', '=', $id],
    		['is_new', '=', '1']
    	])->orderBy('id', 'DESC')->paginate(3, ['*'],  $brand->slug . '-moi-page');
        $products = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['brand_id', '=', $id]
    	])->orderBy('id', 'DESC')->paginate(6, ['*'],  $brand->slug . '-page');
    	$data = [
    		'brand' => $brand,
    		'products' => $products, 
    		'product_new' => $product_new
    	];
    	return view('pages.thuonghieu_sanpham', $data);
    }

    public function about()
    {
    	return view('pages.gioi_thieu');
    }

    public function contacts()
    {
    	return view('pages.lien_he');
    }

    public function getProduct($id)
    {
    	$product = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where('products.id', '=', $id)->first();

    	$product_review = Product_review::join('customers', 'product_reviews.user_id', '=', 'customers.id')->select('product_reviews.*', 'customers.fullname as customer_name')->where('product_reviews.product_id', '=', $id)->orderBy('created_at', 'DESC')->paginate(6, ['*'],  $product->slug . '-reviews-page');

    	$product_new = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['products.is_new', '=', '1'],
    		['products.id', '<>', $id]
    	])->orderBy('id', 'DESC')->take(4)->get();

    	$product_best_sellers = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['products.id', '<>', $id],
    		['products.is_featured', '=', '1']
    	])->orderBy('id', 'DESC')->take(4)->get();

    	$product_relate = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where([
    		['products.id', '<>', $id],
    		['products.brand_id', '=', $product->brand_id]
    	])->orderBy('id', 'DESC')->take(6)->get();
    	$data = [
    		'product' => $product,
    		'product_review' => $product_review,
    		'product_new' => $product_new,
    		'product_best_sellers' => $product_best_sellers,
    		'product_relate' => $product_relate
    	];
    	return view('pages.chitiet_sanpham', $data);
    }

    public function search(Request $request)
    {
        $tukhoa = $request->search;
        $products = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where('name', 'like', '%'.$tukhoa.'%')->orWhere('price', 'like', '%'.$tukhoa.'%')->paginate(8);
        $data = [
            'products' => $products,
            'search' => $tukhoa
        ];
        return view('pages.search', $data);
    }
}
