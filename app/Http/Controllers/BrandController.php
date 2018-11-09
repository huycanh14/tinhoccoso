<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function index()
    {
    	return view('admin.brand.index');
    }

    public function create()
    {
    	return view('admin.brand.create');
    }

    public function post_create(Request $request)
    {
    	$this->validate($request, [
    		'name'=>'required|min:3|max:100|unique:brands,name'
    	], [
    		'name.required' => 'Bạn chưa nhập tên Thương hiệu sản phẩm',
    		'name.unique' => 'Tên thương hiệu đã tồn tại',
    		'name.min' => 'Tên Thương hiệu sản phẩm phải có độ dài từ 3 đến 100 ký tự',
    		'name.max' => 'Tên Thương hiệu sản phẩm phải có độ dài từ 3 đến 100 ký tự'
    	]);

    	$brand = new Brand;
    	$brand->name = $request->name;
    	$brand->slug = changeTitle($request->name);
    	$brand->description = $request->description;
    	$brand->status = $request->status;

    	if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/brand/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/brands/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/brands", $hinh);
            $brand->image = $hinh;
        }
        else
        {
            $brand->image = "";
        }
        $brand->save();

        return redirect('admin/brand/create')->with('thongbao', 'Thêm Thương hiệu thành công');
    }

    public function update($id)
    {
    	$brand = Brand::find($id);
    	$data = [
    		'brand' => $brand
    	];
    	return view('admin.brand.update', $data);
    }

    public function post_update(Request $request, $id)
    {

        $this->validate($request, [
    		'name'=>'required|min:3|max:100'
    	], [
    		'name.required' => 'Bạn chưa nhập tên Thương hiệu sản phẩm',
    		'name.min' => 'Tên Thương hiệu sản phẩm phải có độ dài từ 3 đến 100 ký tự',
    		'name.max' => 'Tên Thương hiệu sản phẩm phải có độ dài từ 3 đến 100 ký tự'
    	]);
    	$null =  Brand::select('id')->where([
            ['name', '=' , $request->name], 
            ['id', '<>', $id]
            ])->get();
        
        if($null == "")
            return redirect('admin/brand/update/'.$id)->withErrors('Tên Thương hiệu này đã tồn tại.');

        $brand = Brand::find($id);
    	$brand->name = $request->name;
    	$brand->slug = changeTitle($request->name);
    	$brand->description = $request->description;
    	$brand->status = $request->status;

    	if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/brand/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/brands/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/brands", $hinh);
            unlink("img/brands" . $brand->image);
            $brand->image = $hinh;
        }
        else
        {
            $brand->image = "";
        }
        $brand->save();
        return redirect('admin/brand/update/' . $id)->with('thongbao', 'Sửa Thương hiệu thành công');
    }

    public function delete($id)
    {
    	$brand = Brand::find($id);
    	$brand->delete();
        return redirect('admin/brand/index')->with('thongbao','Bạn đã xóa thành công');
    }
}
