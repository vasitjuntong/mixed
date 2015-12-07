<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UserSeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(ProductTypeSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(RolesSeeder::class);

        Model::reguard();
    }
}
