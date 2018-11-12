<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	$admins = User::all();
    	$data = [
    		'admins' => $admins
    	];
    	return view('admin.user.index', $data);
    }

    public function delete($id)
    {
    	$admin = User::find($id);
    	$admin->delete();
    	return redirect('admin/user/index')->with('thongbao', 'Xóa Admin thành công');
    }

    public function create()
    {
    	return view('admin.user.create');
    }

    public function post_create(Request $request)
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

    	$user = new User;
    	$user->fullname = $request->fullname;
    	$user->email = $request->email;
    	$user->password = bcrypt($request->password); //dùng để mã hóa
    	// $user->password = $request->password;
    	$user->phone = $request->phone;
    	$user->address = $request->address;
    	$user->role = $request->role;
    	$user->status = $request->status;
    	if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/user/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/users/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/users", $hinh);
            $user->img = $hinh;
        }
        else
        {
            $user->img = "";
        }
		$user->save();
    	return redirect('admin/user/create')->with('thongbao','Thêm User thành công');
    }

    public function update($id)
    {
    	$user = User::find($id);
    	$data = [
    		'user' => $user
    	];
    	return view('admin.user.update', $data);
    }

    public function post_update(Request $request, $id)
    {
    	$this->validate($request, 
    		[
    			"fullname" => 'required|min:3',
    			'email' => 'required|email',
    			'phone' =>'required|numeric'

    		] , [
    			'fullname.required' => 'Bạn chưa Nhập tên đầy đủ',
    			'fullname.min' => 'Tên đầy đủ phải ít nhất 3 kí tự',
    			'email.required' => 'Bạn chưa nhập email',
    			'email' => 'Bạn chưa nhập đúng định dạng email',
    			'phone.required' => 'Bạn chưa nhập số điện thoại',
    			'phone.numeric' => 'Số điện thoại phải là số'
    		]);

    	$user = User::find($id);
    	$user->fullname = $request->fullname;
    	$user->email = $request->email;
    	$user->phone = $request->phone;
    	$user->address = $request->address;

    	$user->role = $request->role;
    	$user->status = $request->status;

		if($request->changePassword == 'on')
		{
			$this->validate($request, 
    		[
    			'password' => 'required|min:3|max:32',
    			'passwordAgain' => 'required|same:password',

    		] , [
    			'password.required' => 'Bạn chưa nhập mật khẩu',
    			'password.min' => 'Mật khẩu phải có ít nhất 3 kí tự',
    			'password.max' => 'Mật khẩu chỉ được tối đa 32 kí tự',
    			'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
    			'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
    		]);
    		$user->password = bcrypt($request->password); //dùng để mã hóa
    		// echo $user->password; 
    		// exit;
    		// $user->password = $request->password;
		}
		if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi = $file->getClientOriginalExtension(); 
            //echo $duoi; return;
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/user/create')->withErrors('File của bạn không phải là file ảnh');
            }
            $name = $file->getClientOriginalName();
            $hinh = str_random(4)."_".$name;
            while(file_exists("img/users/" . $hinh))
            {
                $hinh = str_random(4)."_".$name;
            }
            $file->move("img/users", $hinh);
            if($user->img != "")
            	unlink($user->img);
            $user->img = $hinh;
        }
		$user->save();
    	return redirect('admin/user/update/' . $id)->with('thongbao','Sửa User thành công');
    }

    public function login()
    {
    	return view('admin.login');
    }

    public function post_login(Request $request)
    {
    	$this->validate($request, [
    		'email' => 'required',
    		'password' => 'required|min:3|max:32'
    	], [
    		'email.required' => 'Bạn chưa nhập email',
    		'password.required' => 'Bạn chưa nhập password',
    		'password.min' => 'Password không được nhỏ hơn 3 ký tự',
    		'password.max' => 'Password không được lớn hơn 32 ký tự'
    	]);
    	$email = $request->email;
    	// $password = bcrypt($request->password); //vì laravel yêu cầu mã hóa password, ko muốn đưa mã hóa lên db thì phải mã hóa trk rồi so sánh
    	$password = $request->password;
    	//echo $password; exit();
    	if (Auth::attempt(['email' => $email, 'password' => $password])) 
    	{
    		return redirect('admin/product-category/index');
		}
		else
		{
			return redirect('admin/login')->withErrors('Đăng nhập không thành công');
		}
    }

    public function logout()
    {
        //echo 1; exit;
    	Auth::logout();
    	return redirect('admin/login');
    }
}
