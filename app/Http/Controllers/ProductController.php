<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repositories\ProductRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    protected $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $items = $this->repository->getAll();
        $data = [
            'items' => $items
        ];
        return view('administrators.product.product-list', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        }

        $product = $this->repository->saveProduct($request);

        if ($product) {
            session()->flash('notify', [
                'status' => 'success',
                'message' => 'Successfully updated'
            ]);
            return Redirect::to('/administrator/product/list');
        }
    }

    public function add(Request $request, $id = 0)
    {
        if ($id > 0) {
            $item = $this->repository->find($id);
            if (!$item) {
                return Redirect::to('/administrator/product/list');
            }
        }
        $data = [
            'item' => $item ?? null
        ];
        return view('administrators.product.product-add', $data);
    }

    public function view(Request $request)
    {
        $product = Product::where('alias', trim($request->alias))->where('status', 1)->first();
        if (!$product) {
            return Redirect::to('/');
        }
        $data = [
            'product' => $product
        ];
        return view('pages.product-detail', $data);
    }

    public function destroy($id)
    {
        session()->flash('notify', [
            'status' => 'success',
            'message' => 'Delete successfully'
        ]);
        $this->repository->delete($id);
    }
}
