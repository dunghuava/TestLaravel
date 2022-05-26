<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';


    protected $appends = ['status_label'];

    public function items()
    {
        return $this->hasMany(OrderItem::class,'order_id','id');
    }

    protected function getStatusLabelAttribute()
    {
        switch($this->status)
        {
            case 0 : return 'Pending';
            case 1 : return 'Process';
            case 2 : return 'Delivery';
            case 3 : return 'Success';
            case 4 : return 'Canceled';
        }

    }
}
