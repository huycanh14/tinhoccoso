<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_image;

class ProductController extends Controller
{
    public function index()
    {
    	$products = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->orderBy('id', 'DESC')->get();
    	$data = [
    		'products' => $products
    	];
    	return view('admin.product.index', $data);
    }

    public function create()
    {
    	return view('admin.product.create');
    }

    public function post_create(Request $request)
    {
    	// echo $request->brand_id;
    	// exit();
    	$this->validate($request, [
    		'name'=>'required|min:3|unique:products,name',
    		'price' =>'required|integer|min:4',
    		'colors' => 'required',
    		'qty' =>'required|integer',
    	], [
    		'name.required' => 'Bạn chưa nhập tên Sản phẩm',
    		'name.min' => 'Tên Sản phẩm phải có độ dài từ 3 trở đi',
    		'name.unique' => 'Tên Sản phẩm đã tồn tại',
    		'price.required' => 'Bạn chưa nhập giá Sản phẩm',
    		'price.integer' => 'Giá sản phẩm phải là sô',
    		'price.min' => 'Giá sản phẩm phải >' . number_format(1000) .' VNĐ',
    		'colors.required' => 'Bạn chưa nhập màu sắc của sản phẩm',
    		'qty.required' => 'Bạn chưa nhập giá số lượng Sản phẩm',
    		'qty.integer' => 'Số lượng sản phẩm phải là sô',

    	]);

    	$product = new Product;
    	$product->name = $request->name;
    	$product->slug = changeTitle($request->name);
    	$product->price = $request->price;
    	$product->colors = $request->colors;
    	$product->qty = $request->qty;
    	$product->brand_id = $request->brand_id;
    	$product->product_category_id = $request->product_category_id;
    	$product->description = $request->description;
    	$product->content = $request->content;
    	$product->is_new = $request->is_new;
    	$product->is_sale = $request->is_sale;
    	$product->is_featured = $request->is_featured;
    	$product->status = $request->status;
    	$product->save();
    	//echo $product->id; return;

    	$product_image = new Product_image;
    	if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/product/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/products/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/products", $hinh);
            $product_image->img = "img/products/".$hinh;
        }
        else
        {
            $product_image->img = "";
        }
        $product_image->product_id = $product->id;
        $product_image->save();

        return redirect('admin/product/create')->with('thongbao', 'Thêm Sản phẩm thành công');
    }

    public function update($id)
    {
    	$product = Product::join('product_images', 'products.id', '=', 'product_images.product_id')->select('products.*' ,'product_images.img as img')->where('products.id', '=', $id)->first();
    	$data = [
    		'product' => $product
    	];
    	return view('admin.product.update', $data);
    }

    public function post_update(Request $request, $id)
    {

        $this->validate($request, [
    		'name'=>'required|min:3',
    		'price' =>'required|integer|min:4',
    		'colors' => 'required',
    		'qty' =>'required|integer',
    	], [
    		'name.required' => 'Bạn chưa nhập tên Sản phẩm',
    		'name.min' => 'Tên Sản phẩm phải có độ dài từ 3 trở đi',
    		'price.required' => 'Bạn chưa nhập giá Sản phẩm',
    		'price.integer' => 'Giá sản phẩm phải là sô',
    		'price.min' => 'Giá sản phẩm phải >' . number_format(1000) .' VNĐ',
    		'colors.required' => 'Bạn chưa nhập màu sắc của sản phẩm',
    		'qty.required' => 'Bạn chưa nhập giá số lượng Sản phẩm',
    		'qty.integer' => 'Số lượng sản phẩm phải là sô',

    	]);
    	$null =  Product::select('id')->where([
            ['name', '=' , $request->name], 
            ['id', '<>', $id]
            ])->get();
        
        if($null == "")
            return redirect('admin/product/update/'.$id)->withErrors('Tên Sản phẩm này đã tồn tại.');

        $product = Product::find($id);
    	$product->name = $request->name;
    	$product->slug = changeTitle($request->name);
    	$product->price = $request->price;
    	$product->colors = $request->colors;
    	$product->qty = $request->qty;
    	$product->brand_id = $request->brand_id;
    	$product->product_category_id = $request->product_category_id;
    	$product->description = $request->description;
    	$product->content = $request->content;
    	$product->is_new = $request->is_new;
    	$product->is_sale = $request->is_sale;
    	$product->is_featured = $request->is_featured;
    	$product->status = $request->status;
    	$product->save();

    	$product_image = Product_image::where('product_id', $id)->first();
    	if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/product/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/products/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/products", $hinh);
            unlink( $product_image->img);
            $product_image->img = "img/products/".$hinh;
        }
        else
        {
            $product_image->img = "";
        }
        $product_image->product_id = $product->id;
        $product_image->save();

        return redirect('admin/product/create')->with('thongbao', 'Sửa Sản phẩm thành công');
    }

    public function delete($id)
    {
    	$product = Product::find($id);
    	$product_image = Product_image::where('product_id', $id)->first();
    	unlink( $product_image->img);
    	$product->delete();
        return redirect('admin/product/index')->with('thongbao','Bạn đã xóa thành công');
    }
}
