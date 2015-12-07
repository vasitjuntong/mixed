<?php

use App\Role;
use App\User;
use App\Permission;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
        	'name' => 'manager_receive',
        	'label' => 'Manager of Receive.',
    	]);

        Role::create([
        	'name' => 'manager_requesition',
        	'label' => 'Manager of Requesition.',
    	]);

        Role::create([
        	'name' => 'manager_product_list',
        	'label' => 'Manager of Product list.',
    	]);

        Role::create([
        	'name' => 'manager_product',
        	'label' => 'Manager of Product.',
    	]);

        Role::create([
        	'name' => 'manager_product_type',
        	'label' => 'Manager of Product Type.',
    	]);

        Role::create([
        	'name' => 'manager_unit',
        	'label' => 'Manager of Unit.',
    	]);

        Role::create([
        	'name' => 'manager_location',
        	'label' => 'Manager of Location.',
    	]);

        Role::create([
        	'name' => 'manager_project',
        	'label' => 'Manager of Project.',
    	]);

        Role::create([
        	'name' => 'manager_user',
        	'label' => 'Manager of User.',
    	]);

    	Permission::create([
    		'name' => 'create_form',
    		'label' => 'Create of form.',
		]);

    	Permission::create([
    		'name' => 'update_form',
    		'label' => 'Update of form.',
		]);

    	Permission::create([
    		'name' => 'delete_form',
    		'label' => 'Delete of form.',
		]);

		$roles = Role::all();
		$permissions = Permission::all();

		foreach($roles as $role){
			foreach($permissions as $permission){
				$role->givePermissionTo($permission);
			}
		}

		$user = User::whereEmail('n_vasit@hotmail.com')->first();

		foreach($roles as $role){
			$user->assignRole($role->name);
		}
    }
}
