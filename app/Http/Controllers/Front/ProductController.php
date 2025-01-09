<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    public function index(){

    }
    public function show(Product $product){
//بما ان المتغير الي يعتمد عليه في الراوت الان هو slug ف مش هيقدر يفحص اذا كان المتغير actve
        if($product->status != 'active'){
            abort(404);
        }
        return view('front.products.show', compact('product'));
    }
}
