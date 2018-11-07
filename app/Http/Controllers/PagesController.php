<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_category;
use App\Product_image;
use App\Banner;
use App\Brand;

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
}
