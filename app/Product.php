<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Product extends Model
{
    use ElasticquentTrait;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'price',
        'alias',
        'make',
        'model',
        'regist_date',
        'engine',
        'description',
        'category',
        'status'
    ];

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
