<?php 

return [
	'label' => [
		'name' 			=> 'สินค้าใบเบิก',
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
		'qty'			=> 'QTY',
		'remark'		=> 'Remark',
		'status' 		=> 'Status',
		'created_at'	=> 'Create',
		'updated_at' 	=> 'Update',
	],
	'message_alert' => [
		'create_success' 	=> 'เพิ่มสินค้าใบเบิกเรียบร้อย',
		'update_success' 	=> 'แก้ไขสินค้าใบเบิกเรียบร้อย',
		'delete_success' 	=> 'ลบข้อมูลสินค้าใบเบิกเรียบร้อย',
		'delete_unsuccess' 	=> 'ไม่สามารลบข้อมูลสินค้าใบเบิกได้ มีการใช้งานสินค้าใบเบิกในระบบ',
		'delete_confirm' 	=> 'คุณต้องการลบข้อมูลสินค้าใบเบิกหรือไม่?',
		'cancel_message' 	=> 'ยกเลิกการลบข้อมูลสินค้าใบเบิก',
	],
];