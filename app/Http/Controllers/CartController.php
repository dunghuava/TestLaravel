<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderItem;
use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartSession = Session::get('cart') ?? [];
        $data = [
            'cart' => $cartSession
        ];
        return view('pages.cart', $data);
    }

    public function addToCart(Request $request)
    {
        $id = (int)$request->id;
        $quantity = $request->quantity ?? 1;
        $action = $request->action ?? 'add';
        $product = Product::find($id);
        if (!$product) {
            return Redirect::back();
        }
        $cartSession = Session::get('cart');

        if ($action == 'add' || $action == 'update') {

            if ($action == 'add') {
                $quantity = ($cartSession[$id]['quantity'] ?? 0) + $quantity;
            }

            $cartSession[$id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $quantity,
                'amount' => $product->price * $quantity,
                'category' => $product->category
            ];
        }

        if ($action == 'remove' && isset($cartSession[$id])) {
            unset($cartSession[$id]);
        }

        Session::put('cart', $cartSession);

        return Redirect::to('/cart');
    }

    public function payment(Request $request)
    {
        $cartSession = Session::get('cart') ?? [];

        if (empty($cartSession)) {
            return Redirect::to('/');
        }

        if ($request->method() == 'POST') {

            try {
                $order = new Order();
                $order->name = $request->name;
                $order->user_id = Auth::user()->id;
                $order->email = $request->email;
                $order->address = $request->address;
                $order->phone = $request->phone;
                $order->note = $request->note;

                if ($order->save()) {
                    $order_item = Session::get('cart') ?? [];
                    foreach ($order_item as $item) {
                        OrderItem::create([
                            'order_id' => $order->id,
                            'product_id' => $item['product_id'],
                            'category' => $item['category'],
                            'name' => $item['name'],
                            'quantity' => $item['quantity'],
                            'price' => $item['price'],
                            'amount' => $item['amount']
                        ]);
                    }
                    Session::forget('cart');
                    session()->flash('notify', [
                        'status' => 'success',
                        'message' => 'Your order has been placed successfully'
                    ]);
                    return Redirect::to('/');
                }
                session()->flash('notify', [
                    'status' => 'error',
                    'message' => 'Something went wrong'
                ]);
                return Redirect::back();

            } catch (Exception $e) {
                $order->delete();
                session()->flash('notify', [
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
                return Redirect::back();
            }
        }

        $data = [
            'cart' => $cartSession,
            'user' => Auth::user()
        ];
        return view('pages.pay', $data);
    }
}
