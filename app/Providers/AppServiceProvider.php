<?php

namespace App\Providers;

use App\Product;
use Illuminate\Support\ServiceProvider;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('qtyOver', function ($attribute, $value, $parameters, $validator) {
            $product = Product::where('code', $parameters[1])
                ->first(['id']);

            if ($product == null) {
                return false;
            }
            
            return $value <= $product->stock()->sum('qty');
        });

        Validator::extend('unitOnProduct', function ($attribute, $value, $parameters, $validator) {
            $product = Product::where(function ($query) use ($value, $parameters) {
                $query->where($parameters[0], $parameters[1]);

                $query->whereHas('unit', function ($query) use ($value) {
                    $query->where('name', $value);
                });
            })
                ->count();

            if (!$product) {
                return false;
            }

            return true;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
