<?php


namespace App\Repositories;


use App\Http\Controllers\SearchElastic;
use App\Product;
use Elasticsearch\ClientBuilder;

class SearchElasticRepository implements SearchElastic
{

    public function __construct()
    {

    }

    public function search($query = null)
    {
        if(!$query){
            return Product::where('status',1)->get();
        }
        $response = Product::searchByQuery([
            'match' => [
                'name' => $query,
            ]
        ])->where('status',1);

        return $response;
    }
}
