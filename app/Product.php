<?php

namespace App;

use App\Http\Controllers\SearchElastic;
use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Product extends Model implements SearchElastic
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


    public static function search($query = null)
    {
        $search = self::where('status', 1);
        if ($query) {
            return Product::searchByQuery([
                'match' => $query
            ])->where('status', 1);
        }
        return $search;
    }

    public static function searchQuery($query = null)
    {
        return self::where('status', 1)->where(function ($model) use ($query) {
            $model->where('name', 'like', '%' . $query . '%')
                ->orWhere('engine', 'like', '%' . $query . '%')
                ->orWhere('category', 'like', '%' . $query . '%');
        });
    }
}
