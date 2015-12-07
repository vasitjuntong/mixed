<?php

use App\ProductType;
use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductType::create([
        	'name' => 'OTA'
    	]);

        ProductType::create([
        	'name' => 'OOC'
    	]);

        ProductType::create([
        	'name' => 'A'
    	]);
    }
}
