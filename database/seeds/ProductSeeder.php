<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
        	'product_type_id' 	=> 1,
        	'unit_id' 			=> 1,
        	'mix_no' 			=> 100001,
        	'code'				=> '100001',
        	'description'		=> 'เทป PVC (White)',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 2,
        	'unit_id' 			=> 1,
        	'mix_no' 			=> 100002,
        	'code'				=> '100002',
        	'description'		=> 'เทป PVC (blue)',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 1,
        	'unit_id' 			=> 2,
        	'mix_no' 			=> 100003,
        	'code'				=> '100003',
        	'description'		=> 'เทป PVC (Red)',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 1,
        	'unit_id' 			=> 2,
        	'mix_no' 			=> 100004,
        	'code'				=> '100004',
        	'description'		=> 'เทป PVC (Yellow)',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
    }
}
