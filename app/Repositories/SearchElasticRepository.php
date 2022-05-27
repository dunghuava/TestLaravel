<?php


namespace App\Repositories;


use App\Http\Controllers\SearchElastic;
use App\Product;

class SearchElasticRepository implements SearchElastic
{

    public function search($query = null)
    {
        $search = self::where('status', 1);
        if ($query) {
            return Product::searchByQuery([
                'match' => $query
            ])->where('status', 1)->get();
        }
        return $search;
    }
}