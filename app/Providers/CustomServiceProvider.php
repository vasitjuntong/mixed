<?php

namespace App\Providers;

use App\Receive;
use Illuminate\Support\ServiceProvider;
use Validator;

class CustomServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('receive_item_exists', function ($attribute, $value, $parameters, $validator) {
            $receive = Receive::with([
                'receiveItems',
            ])
                ->whereHas('receiveItems', function ($query) use ($value) {
                    $query->where('product_code', $value);
                })
                ->whereId($parameters[0])
                ->first();

            if ($receive == null) {
                return false;
            }

            return true;
        });

        Validator::replacer('receive_item_exists', function ($message, $attribute, $rule, $parameters) {
            return $message;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
