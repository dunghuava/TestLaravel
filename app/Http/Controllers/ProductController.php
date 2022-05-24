<?php

namespace App\Http\Controllers;

use App\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $items = Product::all();
        return view('administrators.product.product-list',['items'=>$items]);
    }

    public function add(Request $request, $id = 0)
    {
        if($request->method() == 'POST'){
            $id = $request->id ?? 0;
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

                if($file = $request->file('file')){
                    $fileName = 'img_'.time().'_'.strtolower($file->getClientOriginalName());
                    $filePath = storage_path('app/public/images');
                    if($file->move($filePath,$fileName)){
                        if($item->image){
                            $imageOld = $filePath.'/'.$item->image;
                            if(file_exists($imageOld)){
                                unlink($imageOld);
                            }
                        }
                        $item->image = $fileName;
                    }
                }

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
        $data = [
            'item' => $item
        ];
        return view('administrators.product.product-add',$data);
    }

    public function view(Request $request)
    {
        $product = Product::where('alias',trim($request->alias))->where('status',1)->first();
        if(!$product){
            return Redirect::to('/');
        }
        $data = [
            'product' => $product
        ];
        return view('pages.product-detail',$data);
    }

    public function delete(Request $request)
    {
        session()->flash('notify',[
            'status'=>'success',
            'message' => 'Delete successfully'
        ]);
        Product::destroy((int) $request->id);
    }
}
