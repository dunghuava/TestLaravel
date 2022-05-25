<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Product extends Model
{
    use ElasticquentTrait;

    protected $table = 'product';

    protected $mappingProperties = [
        'name' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'engine' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
        'category' => [
            'type' => 'text',
            'analyzer' => 'standard',
        ],
    ];
}
