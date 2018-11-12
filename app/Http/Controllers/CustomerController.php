<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\District;
use App\Province;

class CustomerController extends Controller
{
    public function index()
    {
    	$customers = Customer::all();
    	$data = [
    		'customers' => $customers
    	];
    	return view('admin.customer.index', $data);
    }

    public function delete($id)
    {
    	$customer = Customer::find($id);
    	$customer->delete();
    	return redirect('admin/customer/index')->with('thongbao', 'Xóa khách hàng thành công');
    }
}
