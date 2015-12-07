<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	factory(User::class)->create([
    		'name' => 'Vasit Juntong',
    		'email' => 'n_vasit@hotmail.com',
		]);

		factory(User::class)->create([
    		'name' => 'BEnz',
    		'email' => 'hikaru.benz@gmail.com',
		]);
		
        factory(User::class, 20)->create();
    }
}
