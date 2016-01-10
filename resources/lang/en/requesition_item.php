<?php 

return [
	'label' => [
		'name' 			=> 'Product request',
		'create' 		=> 'รับสินค้าเข้าระบบ',
		'update' 		=> 'แก้ไขใบเบิก',
		'delete' 		=> 'ลบ',
		'empty_data' 	=> 'ไม่มีสินค้าใบเบิกในระบบ',
		'select'		=> 'เลือกโครงการ',
	],
	'buttons' => [
		'create' => 'รับสินค้า',
		'update' => 'แก้ไขสินค้าใบเบิก',
		'delete' => 'ลบสินค้าใบเบิก',
	],
	'attributes' => [
		'receive_id' 	=> 'Receive',
		'product_id' 	=> 'Product',
		'mix_no'		=> 'Mix NO',
		'product_code' 	=> 'Product Code',
		'product_description' 	=> 'Description',
		'location_id'	=> 'Location',
		'location_name' => 'Location',
		'unit_id'		=> 'Unit',
		'unit' 			=> 'Unit',
		'qty'			=> 'QTY',
		'remark'		=> 'Remark',
		'status' 		=> 'Status',
		'created_at'	=> 'Create',
		'updated_at' 	=> 'Update',
	],
	'message_alert' => [
		'create_success' 	=> 'Create product is successfully.',
		'update_success' 	=> 'Update product is successfully.',
		'delete_success' 	=> 'Delete product is successfully.',
		'delete_unsuccess' 	=> 'Can\'t delete product, Product is proccesses.',
		'delete_confirm' 	=> 'Are you sure for delete product?',
		'cancel_message' 	=> 'Cancel for delete product.',
		'item_duplicate_on_request' 	=> 'Product is duplicated.',
	],
];