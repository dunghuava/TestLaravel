<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $product = Product::where('status',1)->get();
        $data = [
            'product' => $product
        ];
        return view('pages.home',$data);
    }
}
