<?php

namespace App\Handlers\Events;

use App\Events\ProductOutOfStock;
use App\Notify;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProductNotifyOutOfStock
{
    protected $notify;
    protected $type = 'product';

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Notify $notify)
    {
        $this->notify = $notify;
    }

    /**
     * Handle the event.
     *
     * @param  ProductOutOfStock $event
     * @return void
     */
    public function handle(ProductOutOfStock $event)
    {
        $notify = Notify::where('type', $this->type)
            ->where('table_id', $event->product->id)
            ->where('read', 0)
            ->count();

        if($notify != 0){
            return;
        }

        $this->notify->create([
            'table_id'    => $event->product->id,
            'type'        => 'product',
            'title'       => "สินค้า Mix NO {$event->product->mix_no} มียอดคงเหลือน้อยกว่า {$event->product->stock_min} กรุณาตรวจสอบ",
            'description' => '...',
            'link'        => url("/product-lists?search={$event->product->mix_no}"),
        ]);
    }
}
