<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\ReceiveNumber
 *
 * @property integer $id
 * @property string $name
 * @property integer $number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ReceiveNumber extends Model
{
    protected $fillable = [
    	'name', 'number',
    ];
}
