<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request){
        $items = Product::all();
        return view('administrators.product-list',['items'=>$items]);
    }

    public function add(Request $request, $id = 0){
        if($request->method() == 'POST'){
            $id = $request->id || 0;
            $action = $request->action ?? 'create';
            try{
                $item = Product::find($id);
                if($action == 'update' && !$item){
                    throw new Exception('Product does not exist');
                }

                if($action == 'create'){
                    $item = new Product();
                }

                $validator = Validator::make($request->all(),[
                    'name' => 'required'
                ]);

                if($validator->fails()){
                    return Redirect::back()->withErrors($validator);
                }

                $item->name = $request->name;
                $item->price = (double) $request->price;
                $item->alias = makeAlias($request->name);
                $item->make = $request->make;
                $item->model = $request->model;
                $item->regist_date = $request->regist_date;
                $item->engine = $request->engine;
                $item->description = $request->description;
                $item->category = $request->category;
                $item->status = (int) $request->status > 1 ? 0 : (int) $request->status;

                if(!$item->save()){
                    throw new Exception('The product could not be saved, please try again');
                }
                session()->flash('notify',[
                    'status'=>'success',
                    'message' => 'Successfully updated'
                ]);
                return Redirect::to('/administrator/product/list');

            }catch(Exception $e){
                session()->flash('notify',[
                    'status'=>'error',
                    'message' => $e->getMessage()
                ]);
                return Redirect::to('/administrator/product/add');
            }
        }
        $item = null;
        if((int) $id > 0){
            $item = Product::find((int) $id);
            if(!$item){
                return Redirect::to('/administrator/product/list');
            }
        }
        return view('administrators.product-add',['item'=>$item]);
    }

    public function view(Request $request){
        return view('pages.product-detail');
    }
}
