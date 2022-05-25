<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_item';

    protected $fillable = [
        'order_id',
        'product_id',
        'category',
        'name',
        'price',
        'quantity',
        'amount'
    ];

    protected function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
