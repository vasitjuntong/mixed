<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementAll extends Model
{
	const STATUS_CEATE = 'create';
	const STATUS_PADDING = 'padding';
	const STATUS_SUCCESS = 'success';
	const STATUS_CANCEL = 'cancel';

	const TYPE_RECEIVE = 'receive';
	const TYPE_REQUISITION = 'requisition';

    protected $fillable = [
        'table_id',
        'type',
        'project',
        'dn',
        'product_mix_no',
        'product_description',
        'product_qty',
        'product_unit',
        'location_or_site_name',
        'status',
    ];
}
