<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonStatus extends Model
{
    protected $table = 'lesson_statuses';

    protected $fillable = [
        'lesson_type',
        'name',
        'order_index',
        'color',
        'color_alt_1',
        'color_alt_2',
        'default',
        'icon_url'
    ];
}
