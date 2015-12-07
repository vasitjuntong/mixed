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
        	'code'				=> 'PD001',
        	'description'		=> 'ต้นไม้',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 2,
        	'unit_id' 			=> 1,
        	'mix_no' 			=> 100002,
        	'code'				=> 'PD002',
        	'description'		=> 'ใบหญ้า',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 1,
        	'unit_id' 			=> 2,
        	'mix_no' 			=> 100003,
        	'code'				=> 'PD003',
        	'description'		=> 'โต๊ะ',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
        Product::create([
        	'product_type_id' 	=> 1,
        	'unit_id' 			=> 2,
        	'mix_no' 			=> 100004,
        	'code'				=> 'PD004',
        	'description'		=> 'ผ้าม่าน',
        	'use_serial_no'		=> Product::USE_SERIAL_NO,
    	]);
    }
}
