<?php

use App\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
        	'name' => 'ea',
    	]);

        Unit::create([
        	'name' => 'cc',
    	]);
    }
}
