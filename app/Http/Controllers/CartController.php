<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CartController extends Controller
{
    public function index ()
    {
        $cartSession = Session::get('cart') ?? [];
        $data = [
            'cart' => $cartSession
        ];
        return view('pages.cart',$data);
    }

    public function addToCart(Request $request)
    {
        $id = (int) $request->id;
        $quantity = $request->quantity ?? 1;
        $action = $request->action ?? 'add';
        $product = Product::find($id);
        if(!$product){
            return Redirect::back();
        }
        $cartSession = Session::get('cart');

        if($action == 'add' || $action == 'update'){

            if($action == 'add'){
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

        if($action == 'remove' && isset($cartSession[$id])){
            unset($cartSession[$id]);
        }

        Session::put('cart',$cartSession);

        return Redirect::to('/cart');
    }

    public function login(Request $request)
    {
        if(Auth::check()){
            return Redirect::to('/');
        }

        if($request->method() == 'POST'){
            $email = $request->email;
            $password = $request->password;
            $authorization = [
                'email' => $email,
                'password' => $password
            ];
            if(!Auth::attempt($authorization)){
                session()->flash('notify',[
                    'status'=>'error',
                    'message' => 'Email address or password is incorrect !'
                ]);
            }else{
                $redirect_url = $request->get('redirect_url') ?? '/';
                return Redirect::to($redirect_url);
            }

        }
        return view('pages.login');
    }

    public function payment(Request $request)
    {
        if(!Auth::check()){
            return Redirect::to('/cart/login?redirect_url='.$request->url());
        }
        $cartSession = Session::get('cart') ?? [];
        $data = [
            'cart' => $cartSession,
            'user' => Auth::user()
        ];
        return view('pages.pay',$data);
    }
}
