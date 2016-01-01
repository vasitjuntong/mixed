<?php

namespace App\Providers;

use Validator;
use App\Product;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('qtyOver', function($attribute, $value, $parameters, $validator) {
            $product = Product::where('code', $parameters[1])
                ->first(['id']);

            if($product == null){
                return false;
            }
            
            return $value < $product->stock()->sum('qty');
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
