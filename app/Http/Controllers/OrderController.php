<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_item;
use App\Customer;
use App\Product;
use App\District;
use App\Province;
use App\Cart;
use Session;

class OrderController extends Controller
{
    public function indexNew()
    {
    	$orderNew = Order::where('orders.status', '1')->get();
    	$orders = Order::join('districts', 'orders.district_id', '=', 'districts.id')->join('provinces', 'orders.province_id', '=', 'provinces.id')->select('orders.*', 'districts.name as huyen', 'provinces.name as tinh')->where('orders.status', '1')->orderBy('orders.id', 'desc')->get();
    	$data = [
    		'orderNew' => $orderNew,
    		'orders' => $orders
    	];
    	return view('admin.order.index', $data);
    }

    public function indexOld()
    {
        $orderOld = Order::where('orders.status', '0')->get();
        $orders = Order::join('districts', 'orders.district_id', '=', 'districts.id')->join('provinces', 'orders.province_id', '=', 'provinces.id')->select('orders.*', 'districts.name as huyen', 'provinces.name as tinh')->where('orders.status', '0')->get();
        $data = [
            'orderOld' => $orderOld,
            'orders' => $orders
        ];
        return view('admin.order.index', $data);
    }

    public function deleteNew($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('admin/order_new/index')->with('thongbao', 'Xóa đơn hàng thành công');
    }

    public function deleteOld($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect('admin/order_old/index')->with('thongbao', 'Xóa đơn hàng thành công');
    }

    public function update(Request $request, $id)
    {
        //exit(1);
        $order = Order::find($id);
        $order->status = $request->status;
        $order->updated_at = date('Y-m-d H:i:s');
        $order->save();
        return redirect('admin/order_item/index/' .$id)->with('thongbao', 'Lưu thành công');
    }

    public function getAddToCart(Request $request, $id)
    {
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product, $id);
        $request->session()->put('cart', $cart);//echo(1); exit();
        return redirect()->back();
    }

    public function getDeleteItemCart($id)
    {//echo 1; exit;
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items) > 0)
        {
            Session::put('cart', $cart);
        }
        else
        {
            Session::forget('cart');
        }
        return redirect()->back();
    }
    public function checkout()
    {
        
            $provinces = Province::all();
            $data = [
                'provinces' => $provinces
            ];
            return view('pages.dat_hang', $data);
    }

    public function post_checkout(Request $request)
    {
        if(Session::has('cart'))
        {
            $this->validate($request, [
                'fullname' => 'required',
                'email' => 'required|email',
                'address' => 'required',
                'phone' => 'required|numeric'
            ], [
                'fullname.required' => 'Bạn chưa nhập Họ tên',
                'email.required' => 'Bạn chưa nhập địa chỉ email',
                'email' => 'Bạn chưa nhập đúng định dạng email',
                'address.required' => 'Bạn chưa nhập địa chỉ',
                'phone.required' => 'Bạn chưa nhập số điện thoai',
                'phone.numeric' => 'Số điện thoại chưa đúng định dạng'
            ]);

            $order = new Order;
            if(Session::has('user'))
            {
                $order->user_id = Session('user')->id;
            }
            $order->fullname = trim($request->fullname);
            $order->email = trim($request->email);
            $order->phone = trim($request->phone);
            $order->address = trim($request->address);
            $order->province_id = trim($request->province_id);
            $order->district_id = trim($request->district_id);
            $order->payment = trim($request->payment);
            $order->note = trim($request->note);
            $order->amount = Session('cart')->totalPrice;
            $order->save();
            $order_id = $order->id;

            $order_items = Session::get('cart')->items;
            foreach ($order_items as $item) {
                $order_item = new Order_item;
                $order_item->order_id = $order_id;
                $order_item->product_id = $item['item']['id'];
                $order_item->qty = $item['qty'];
                $order_item->price = $item['item']['price'];
                $order_item->save();
            }
            Session::forget('cart');
            return redirect()->back()->with('thongbao','Bạn mua hàng thành công');
        }
        else
        {
            return redirect()->back()->withErrors('Đơn hàng đang trống');
        }
    }
}
