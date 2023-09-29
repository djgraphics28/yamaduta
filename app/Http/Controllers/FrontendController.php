<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function shop()
    {
        return view('yamaduta.shop');
    }

    public function aboutUs()
    {
        return view('yamaduta.about');
    }

    public function contact()
    {
        return view('yamaduta.contact');
    }

    public function addToCart(Request $request)
    {
        \Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'Product is Added to Cart Successfully !');

        return redirect()->route('cart.list');
    }

    public function cartList()
    {
        return view('yamaduta.cart');
    }

    public function show(Product $product)
    {
        return view('yamaduta.viewproducts', compact('product'));
    }
}
