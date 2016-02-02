<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Notify
 *
 * @property integer $id
 * @property integer $table_id
 * @property string $type
 * @property string $title
 * @property string $description
 * @property string $link
 * @property integer $read
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
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
