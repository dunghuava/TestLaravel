<?php


namespace App\Repositories;


use App\Http\Controllers\SearchElastic;
use App\Product;
use Elasticsearch\ClientBuilder;

class SearchElasticRepository implements SearchElastic
{

    public function __construct()
    {
        ClientBuilder::create()->setHosts(['http://localhost:9200/'])->build();
    }

    public function search($query = null)
    {
        $items = Product::searchByQuery(['match' => ['title' => $query]])->where('status', 1)->get();
        return $items;
    }
}
