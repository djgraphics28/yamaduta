<?php

namespace App\Http\Controllers;

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
}
