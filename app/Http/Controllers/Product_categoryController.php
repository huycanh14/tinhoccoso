<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product_category;

class Product_categoryController extends Controller
{
	//const CREATED_AT = null;
    public function index()
    {
    	return view('admin.product_category.index');
    }

    public function create()
    {
    	return view('admin.product_category.create');
    }

    public function post_create(Request $request)
    {
    	//echo "string";
    	$this->validate($request, [
    		'name'=>'required|min:3|max:100'
    	], [
    		'name.required' => 'Bạn chưa nhập tên Danh mục sản phẩm',
    		'name.min' => 'Tên Danh mục sản phẩm phải có độ dài từ 3 đến 100 ký tự',
    		'name.max' => 'Tên Danh mục sản phẩm phải có độ dài từ 3 đến 100 ký tự'
    	]);

    	//$created_at = $updated_at = date('Y-m-d H:i:s');

    	//const CREATED_AT = null;
    	$product_category = new Product_category;
    	$product_category->name = $request->name;
    	$product_category->slug = changeTitle($request->name);
    	$product_category->status = $request->status;
    	// $product_category->created_at = $created_at;
    	//$product_category->updated_at = $updated_at;
    	$product_category->save();
    	return redirect('admin/product-category/create')->with('thongbao', 'Thêm thành công');
    }

    public function update($id)
    {
    	$product_category = Product_category::find($id);
    	$data = [
    		'product_category' => $product_category
    	];
    	return view('admin.product_category.update', $data);
    }

    public function post_update(Request $request, $id)
    {

        $product_category = Product_category::find($id);
        $this->validate($request, [
    		'name'=>'required|min:3|max:100'
    	], [
    		'name.required' => 'Bạn chưa nhập tên Danh mục sản phẩm',
    		'name.min' => 'Tên Danh mục sản phẩm phải có độ dài từ 3 đến 100 ký tự',
    		'name.max' => 'Tên Danh mục sản phẩm phải có độ dài từ 3 đến 100 ký tự'
    	]);
       	$null =  Product_category::select('id')->where([
            ['name', '=' , $request->name], 
            ['id', '<>', $id]
            ])->get();
        
        if($null == "")
            return redirect('admin/product-category/update/'.$id)->withErrors('Tên Danh mục này đã tồn tại.');
        $tgian = date('Y-m-d H:i:s');
        $product_category->name = $request->name;
    	$product_category->slug = changeTitle($request->name);
    	$product_category->status = $request->status;
    	//$product_category->updated_at = $tgian;
    	//$product_category->updated_at = ;
    	$product_category->save();
    	return redirect('admin/product-category/update/'.$id)->with('thongbao', 'Sửa Danh mục thành công');
    }

    public function delete($id)
    {
    	$product_category = Product_category::find($id);
    	$product_category->delete();
        return redirect('admin/product-category/index')->with('thongbao','Bạn đã xóa thành công');
    }
}
