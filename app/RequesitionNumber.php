<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\RequesitionNumber
 *
 * @property integer $id
 * @property string $name
 * @property integer $number
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class RequesitionNumber extends Model
{
    protected $fillable = [
    	'name',
    	'number',
    ];
}
