<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notify extends Model
{
    protected $fillable = [
        'type',
        'table_id',
        'title',
        'description',
        'link',
    ];
}
