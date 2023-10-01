<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ShippingInfo;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\AdminNotification;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function orders(Request $request)
    {
        $search = $request->search;
        $pageTitle = "Order History";
        $orders = Order::where('user_id',auth()->id())
        ->when($search,function($q,$search){
             return $q->where('order_track',$search);
        })
        ->where(function($q){
            $q->where('pay_status', 1)->where('payment_type', 1)
            ->orWhere('payment_type', 2);
        })
        ->latest()->paginate(getPaginate());
        return view($this->activeTemplate.'user.order_history',compact('pageTitle','orders','search'));
    }



    public function submitOrder(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'city'  => 'required',
            'address' => 'required',
            'post_code' => 'required|numeric',
            'shipping' => 'required|in:1,2',
            'payment' => 'required|in:1,2',
            'product_id' => 'required|int',
            'qty'   => 'required|numeric|gt:0'
        ]);

        $general = GeneralSetting::first();
        $product = Product::find($request->product_id);
        if(!$product){
            $notify[]=['error','Product not found!'];
            return back()->withNotify($notify);
        }
        if($product->stock < $request->qty){
            $notify[]=['error','Quantity exceeds the remaining stock!'];
            return back()->withNotify($notify);
        }

        $price = $product->price() * $request->qty;

        $order = new Order();
        $order->order_track = orderTrack();
        $order->user_id = auth()->id();
        $order->product_id = $request->product_id;
        $order->qty = $request->qty;

        $order->product_price = getAmount($product->price());
        $order->delivery_area = $request->shipping;
        $order->payment_type = $request->payment;

        if($request->shipping == 1 && $general->shipping_charge_inside != -1) {
            $totalAmount = getAmount($price + $general->shipping_charge_inside);
        }elseif($request->shipping == 2 && $general->shipping_charge_outside != -1){
            $totalAmount = getAmount($price + $general->shipping_charge_outside);
        }
        else $totalAmount = getAmount($price);

        $order->total_amount = $totalAmount;
        $order->save();

        //shipping info
        $shipping = new ShippingInfo();
        $shipping->order_id = $order->id;
        $shipping->name = $request->name;
        $shipping->email = $request->email;
        $shipping->phone = $request->phone;
        $shipping->city = $request->city;
        $shipping->address = $request->address;
        $shipping->post_code = $request->post_code;
        $shipping->additional = $request->additional;
        $shipping->save();

        if($request->payment == 2){
            $product->stock -= $request->qty;
            $product->save();

            $adminNotification = new AdminNotification();
            $adminNotification->user_id = auth()->id();
            $adminNotification->title = 'New order has been placed';
            $adminNotification->click_url = urlPath('admin.orders.pending',['search'=>$order->order_track]);
            $adminNotification->save();

            notify(auth()->user(), 'ORDER_PLACED', [
                'product' => $order->product->name,
                'qty' => $order->qty,
                'currency' => $general->cur_text,
                'p_price' => getAmount( $order->product_price),
                'total_price' => getAmount($order->total_amount),
                'time' => showDateTime($order->created_at,'d M Y @ h:i a'),
              ]);

            $notify[]=['success','Your order has been placed successfully'];
            return redirect(route('user.orders'))->withNotify($notify);

        }else {
            session()->put('order_id',$order->id);
            return redirect(route('user.deposit'));
        }
    }

    public function cancelOrder(Request $request)
    {
        $order = Order::findOrFail($request->id);

        if($order->status == 2 ||$order->status == 1 || $order->pay_status == 1){
            $notify[]=['error','Order can not be cancelled'];
            return back()->withNotify($notify);
        }

        $order->status = 3;
        $order->save();

        $order->product->stock += $order->qty;
        $order->product->save();
        $notify[]=['success','Order has been cancelled'];
        return back()->withNotify($notify);
    }
}
