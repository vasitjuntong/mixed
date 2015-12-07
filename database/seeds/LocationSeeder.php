<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
        	'name' => 'LO001'
    	]);
        Location::create([
        	'name' => 'LO002'
    	]);
        Location::create([
        	'name' => 'LO003'
    	]);
        Location::create([
        	'name' => 'LO004'
    	]);
    }
}
