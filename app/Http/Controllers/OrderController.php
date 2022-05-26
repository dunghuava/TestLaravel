<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index ()
    {
        $orders = Order::all();

        $data = [
            'orders' => $orders
        ];
        return view('administrators.order.order-list',$data);
    }
}
