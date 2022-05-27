<?php


namespace App\Repositories;


use App\Http\Controllers\SearchEloquent;
use App\Product;

class SearchRepository implements SearchEloquent
{

    public function search($query = null)
    {
        return Product::where('status', 1)->where(function ($model) use ($query) {
            $model->where('name', 'like', '%' . $query . '%')
                ->orWhere('engine', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%');
        })->get();
    }
}