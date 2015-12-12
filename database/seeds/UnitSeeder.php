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
        	'name' => 'PCS',
    	]);

        Unit::create([
        	'name' => 'EA',
    	]);

        Unit::create([
            'name' => 'SET',
        ]);

        Unit::create([
            'name' => 'MT',
        ]);
    }
}
