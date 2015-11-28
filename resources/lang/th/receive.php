<?php 

return [
	'label' => [
		'name' 			=> 'ใบรับสินค้า',
		'create' 		=> 'รับสินค้าเข้าระบบ',
		'update' 		=> 'แก้ไขรับสินค้า',
		'delete' 		=> 'ลบ',
		'empty_data' 	=> 'ไม่มีใบรับสินค้าในระบบ',
		'select'		=> 'เลือกโครงการ',
		'add_product'	=> 'เพิ่มสินค้าใบรับ',
	],
	'buttons' => [
		'create' => 'รับสินค้า',
		'update' => 'แก้ไขใบรับสินค้า',
		'delete' => 'ลบใบรับสินค้า',
	],
	'attributes' => [
		'document_no' 	=> 'DN NO',
		'po_no' 	  	=> 'PO NO',
		'ref_no' 		=> 'Referrence NO',
		'project_id' 	=> 'โครงการ',
		'project_code' 	=> 'Code โครงการ',
		'status' 		=> 'สถานะใบเบิก',
		'remark'		=> 'หมายเหตุ',
		'created_at'	=> 'เบิกเมื่อ',
		'updated_at'	=> 'แก้ไข',

		'stock' 		=> 'Stock',
		'create_by'		=> 'ผู้ขอเบิก',
	],
	'message_alert' => [
		'create_success' 	=> 'เพิ่มใบรับสินค้าเรียบร้อย',
		'update_success' 	=> 'แก้ไขใบรับสินค้าเรียบร้อย',
		'delete_success' 	=> 'ลบข้อมูลใบรับสินค้าเรียบร้อย',
		'delete_unsuccess' 	=> 'ไม่สามารลบข้อมูลใบรับสินค้าได้ มีการใช้งานใบรับสินค้าในระบบ',
		'delete_confirm' 	=> 'คุณต้องการลบข้อมูลใบรับสินค้าหรือไม่?',
		'cancel_message' 	=> 'ยกเลิกการลบข้อมูลใบรับสินค้า',
	],
];