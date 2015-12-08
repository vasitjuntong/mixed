<?php 

return [
	'label' => [
		'name' 			=> 'Product List',
		'create' 		=> 'Create',
		'update' 		=> 'Update',
		'delete' 		=> 'Delete',
		'empty_data' 	=> 'Data not found.',
	],
	'buttons' => [
		'create' => 'Create',
		'update' => 'Update',
		'delete' => 'Delete',
		'search' => 'Search Product',
	],
	'attributes' => [
		'product_type_id' 	=> 'Product Type',
		'unit_id' 			=> 'Unit',
		'unit' 				=> 'Unit',
		'mix_no' 			=> 'Mix NO',
		'code' 				=> 'Product Code',
		'description' 		=> 'Description',
		'stock_min' 		=> 'Minimum',
		'use_serial_no' 	=> 'Use Serial NO',
		'pic_path' 			=> 'Path รูป',
		'pic_name' 			=> 'ชื่อรูป',
		'status' 			=> 'Status',
		'created_at' 		=> 'Create',
		'updated_at' 		=> 'Update',

		'on_hand' 			=> 'On Hand',
		'on_stock' 			=> 'On Stock',
		'on_order' 			=> 'On Order',
	],
	'message_alert' => [
		'create_success' 	=> 'เพิ่มสินค้าเรียบร้อย',
		'update_success' 	=> 'แก้ไขสินค้าเรียบร้อย',
		'delete_success' 	=> 'ลบข้อมูลสินค้าเรียบร้อย',
		'delete_unsuccess' 	=> 'ไม่สามารลบข้อมูลสินค้าได้ มีการใช้งานสินค้าในระบบ',
		'delete_confirm' 	=> 'คุณต้องการลบข้อมูลสินค้าหรือไม่?',
		'cancel_message' 	=> 'ยกเลิกการลบข้อมูลสินค้า',
	],
];