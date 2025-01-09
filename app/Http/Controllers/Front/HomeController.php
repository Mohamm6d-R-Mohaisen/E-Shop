<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\View\Components\CartMenu;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    //

    public function index()
    {
//     dd(date('Y-m-d H:i:s'));
        $products=Product::with('categary')
            ->active()
            ->limit(8)
            ->get();


        return view('front.home',compact('products'));
    }
}
