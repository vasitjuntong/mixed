<?php

namespace App;
use Log;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Stock
 *
 * @property-read \App\Product $product
 * @property-read \App\Location $location
 * @property integer $id
 * @property integer $product_id
 * @property integer $location_id
 * @property integer $qty
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Stock extends Model
{
    protected $fillable = ['product_id', 'location_id', 'qty'];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
	public function location()
	{
		return $this->belongsTo(Location::class);
	}

	public function cutStock(Requesition $requesition)
	{
		$error = false;

		$items = $requesition->items()
			->where('status', Requesition::SUCCESS)
			->get();

		foreach($items as $item){
			$stockTem["{$item->product_id}_{$item->location_id}"] = self::where('product_id', $item->product_id)
				->where('location_id', $item->location_id)
				->first();

			$stock = $stockTem["{$item->product_id}_{$item->location_id}"];

			if($stock->qty < $item->qty){
				$error = true;

				Log::warning('cus-stock: item is not enouge.', [
					'requesition_id' => $item->requesition_id,
					'product' => $stock->product_id,
					'location' => $stock->location_id,
					'item-qty' => $item->qty,
					'stock' => $stock->qty,
				]);
			}
		}

		if($error){
			
			flash()
				->error(
					trans('requesition.label.name'),
					trans('requesition.message_alert.requesition_error_case_item_not_enouge')
				);

			return;
		}

		foreach($items as $item){
			$stock = $stockTem["{$item->product_id}_{$item->location_id}"];
			$stock->qty = $stock->qty - $item->qty;

			Log::info('cut-stock: success', [
				'requesition_id' => $item->requesition_id,
				'product' => $stock->product_id,
				'location' => $stock->location_id,
				'item-qty' => $item->qty,
				'stock-after-cus' => $stock->qty,
			]);

			$stock->save();
		}
	}
}
