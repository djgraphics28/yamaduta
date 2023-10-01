<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function allOrders(Request $request)
    {
        $search = $request->search;
        $pageTitle = "Manage Orders";

        $orders = Order::when($search, function($q,$search){
            $q->where('order_track',$search);
        })
        ->where(function($q){
            $q->where('pay_status', 1)->where('payment_type', 1)
            ->orWhere('payment_type', 2);
        })
        ->with(['user','product'])
        ->latest()->paginate(getPaginate());

        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }

    public function orderDetails($id)
    {
        $pageTitle  = "Order Details";
        $order      = Order::findOrFail($id);
        $contact    = getContent('contact_us.content', true);
        return view('admin.orders.details',compact('pageTitle','order','contact'));
    }

    public function pending(Request $request)
    {
        $pageTitle = "Pending Orders";
        $search = $request->search;
        $orders = Order::when($search,function($q,$search){
            $q->where('order_track',$search);
        })->where('status',0)
        ->where(function($q){
            $q->where('pay_status', 1)->where('payment_type', 1)
            ->orWhere('payment_type', 2);
        })
        ->with('user', 'product')
        ->paginate(getPaginate());
        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }

    public function processing(Request $request)
    {
        $pageTitle = "Processing Orders";
        $search = $request->search;
        $orders = Order::when($search,function($q,$search){
            $q->where('order_track',$search);
        })
        ->where('status',2)
        ->with('user', 'product')
        ->paginate(getPaginate());
        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }

    public function delivered(Request $request)
    {
        $pageTitle = "Delivered Orders";
        $search = $request->search;
        $orders = Order::when($search,function($q,$search){
            $q->where('order_track',$search);
        })->where('status',1)->with('user')->paginate(getPaginate());
        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }
    public function cancelled(Request $request)
    {
        $pageTitle = "Cancelled Orders";
        $search = $request->search;
        $orders = Order::when($search,function($q,$search){
            $q->where('order_track',$search);
        })->where('status',3)->with('user')->paginate(getPaginate());
        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }
    public function codOrders(Request $request)
    {
        $pageTitle = "Cash On Delivery Orders";
        $search = $request->search;
        $orders = Order::when($search,function($q,$search){
            $q->where('order_track',$search);
        })->where('payment_type',2)->with('user')->paginate(getPaginate());
        return view('admin.orders.all',compact('search','pageTitle','orders'));
    }

    public function markAsProcess($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 2;
        $order->save();
        $notify[]=['success','Order marked as processing'];
        return back()->withNotify($notify);
    }
    public function markAsDelivered($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 1;
        $order->save();
        $notify[]=['success','Order marked as delivered'];
        return back()->withNotify($notify);
    }
    public function cancel(Request $request)
    {
        $order = Order::findOrFail($request->id);
        $order->status = 3;
        $order->save();
        $notify[]=['success','Order has been cancelled'];
        return back()->withNotify($notify);
    }
}
