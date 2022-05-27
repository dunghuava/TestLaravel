<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $productRepo;

    public function __construct()
    {
        $this->productRepo = new ProductRepository();
    }

    public function index()
    {
        $query = request()->get('q', '');
        $product = $this->productRepo->getProductHomePage($query);
        $data = [
            'product' => $product,
            'query' => $query
        ];

        return view('pages.home', $data);
    }
}
