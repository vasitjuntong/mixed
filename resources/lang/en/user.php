<?php 

return [
	'label' => [
		'name' => 'User',
		'assign_role' => 'Assign Role',
		'create' => 'Create',
		'update' => 'Update',
		'delete' => 'Delete',
		'empty_data' => 'Data not found.',
	],

	'attributes' => [
		'name' => 'Name',
		'email' => 'Email',
		'password' => 'Password',
		'role' => 'Role',
		'created_at' => 'Create',
		'updated_at' => 'Update',
	],

	'buttons' => [
		'create' => 'Create',
		'update' => 'Update',
		'delete' => 'Delete',

		'assign_role' => 'Assign Role',

		'search' => 'Search',
	],

	'message_alert' => [
		'assign_role_success' => 'Assign role to user is successfully.',
		'assign_role_error' => 'Assign role to user is errors.',

		'delete_success' 	=> 'User delete is successfully.',
		'delete_unsuccess' 	=> 'User processing on system. Can\'t delete user.',
		'delete_confirm' 	=> 'Are you sure for delete user?',
		'cancel_message' 	=> 'User is delete cancel.',
	],
];