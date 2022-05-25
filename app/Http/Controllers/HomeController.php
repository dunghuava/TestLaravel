<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index ()
    {
        $query = request()->get('q');
        $product = Product::where('status',1);
        if ($query) {
            $product->searchByQuery([
                'match' => $query
            ]);
        }
        $data = [
            'product' => $product->get(),
            'query' => $query
        ];

        return view('pages.home',$data);
    }
}
