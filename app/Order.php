<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';


    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }
}
