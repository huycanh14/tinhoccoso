<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Customer;
use App\District;
use App\Province;
use Session;

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

    public function login()
    {
        if(Session::has('user'))
            return redirect()->back();
        else
            return view('pages.login');
    }

    public function post_login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3|max:32',
        ] , [ 
            'email.required' => 'Bạn chưa nhập Email',
            'email' => 'Email không đúng định dạng',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 kí tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 kí tự',
        ]);
        $email = $request->email;
        $password = $request->password;
        $customer = Customer::where('email', $email)->first();
        if(empty($customer))
            return redirect()->back()->withErrors('Đăng nhập thất bại');
        else
        {
            if(Hash::check($password, $customer->password))
            {
                //Tạo session
               $request->session()->put('user', $customer);
               //return redirect()->back();
               return redirect('trang-chu');
            }
            else
            {
                return redirect()->back()->withErrors('Đăng nhập thất bại');
            }
        }
    }

    public function signup()
    {
        $provinces = Province::all();
        $data = [
            'provinces' => $provinces
        ];
        return view('pages.signup', $data);
    }

    public function post_signup(Request $request)
    {
        $this->validate($request, 
        [
            "fullname" => 'required|min:3',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:3|max:32',
            'passwordAgain' => 'required|same:password',
            'phone' =>'required|numeric'

        ] , [
            'fullname.required' => 'Bạn chưa Nhập tên đầy đủ',
            'fullname.min' => 'Tên đầy đủ phải ít nhất 3 kí tự',
            'email.required' => 'Bạn chưa nhập email',
            'email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 3 kí tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 kí tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số'
        ]);
        $customer = new Customer;
        $customer->fullname = $request->fullname;
        $customer->email = $request->email;
        $customer->gender = $request->gender;
        $customer->address = $request->address;
        $customer->district_id = $request->district_id;
        $customer->province_id = $request->province_id;
        $customer->phone = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->save();
        return redirect('signup')->with('thongbao','Đăng ký tài khoản thành công');
    }

    public function logout()
    {
        Session::forget('user');
        return redirect()->back();
    }
}
