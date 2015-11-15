<?php 

return [
	'label' => [
		'name' 			=> 'สินค้า',
		'create' 		=> 'สร้าง',
		'empty_data' 	=> 'ไม่มีสินค้าในระบบ',
	],
	'attributes' => [
		'product_type_id' 	=> 'ประเภท',
		'unit_id' 			=> 'หน่วย',
		'mix_no' 			=> 'Mix NO',
		'code' 				=> 'Code สินค้า',
		'description' 		=> 'รายละเอียด',
		'stock_min' 		=> 'น้อยที่สุด',
		'use_serial_no' 	=> 'ใช้ Serial NO',
		'pic_path' 			=> 'Path รูป',
		'pic_name' 			=> 'ชื่อรูป',
		'created_at' 		=> 'เพิ่มเมื่อ',
		'updated_at' 		=> 'อัพเดตเมื่อ',
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