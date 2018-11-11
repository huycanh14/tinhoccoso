<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_item;
use App\Customer;
use App\Product;
use App\District;
use App\Province;

class OrderController extends Controller
{
    public function indexNew()
    {
    	$orderNew = Order::where('orders.status', '1')->get();
    	$orders = Order::join('districts', 'orders.district_id', '=', 'districts.id')->join('provinces', 'orders.province_id', '=', 'provinces.id')->select('orders.*', 'districts.name as huyen', 'provinces.name as tinh')->where('orders.status', '1')->get();
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
}
