<?php


namespace App\Repositories;


use App\Http\Controllers\SearchElastic;
use App\Product;

class SearchElasticRepository implements SearchElastic
{

    public function search($query = null)
    {
        $search = Product::where('status', 1)->get();
        if ($query) {
            Product::createIndex($shards = null, $replicas = null);
            Product::putMapping($ignoreConflicts = true);
            Product::addAllToIndex();
            return Product::searchByQuery([
                'match' => ['name' => $query]
            ])->where('status', 1)->get();
        }
        return $search;
    }
}