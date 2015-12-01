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
		'confirm_receive' => 'ยืนยันรับสินค้า',
	],
	'attributes' => [
		'document_no' 	=> 'DN NO',
		'po_no' 	  	=> 'PO NO',
		'ref_no' 		=> 'Referrence NO',
		'project_id' 	=> 'โครงการ',
		'project_code' 	=> 'Code โครงการ',
		'status' 		=> 'สถานะรับสินค้า',
		'remark'		=> 'หมายเหตุ',
		'created_at'	=> 'วันขอรับสินค้า',
		'updated_at'	=> 'แก้ไข',

		'stock' 		=> 'Stock',
		'create_by'		=> 'ผู้ขอรับสินค้า',
		'success_status' => 'เลือกสินค้าเข้าระบบ'
	],
	'message_alert' => [
		'create_success' 	=> 'เพิ่มใบรับสินค้าเรียบร้อย',
		'update_success' 	=> 'แก้ไขใบรับสินค้าเรียบร้อย',
		'delete_success' 	=> 'ลบข้อมูลใบรับสินค้าเรียบร้อย',
		'delete_unsuccess' 	=> 'ไม่สามารลบข้อมูลใบรับสินค้าได้ มีการใช้งานใบรับสินค้าในระบบ',
		'delete_confirm' 	=> 'คุณต้องการลบข้อมูลใบรับสินค้าหรือไม่?',
		'cancel_message' 	=> 'ยกเลิกการลบข้อมูลใบรับสินค้า',

		'review_confirm' 	=> 'คุณต้องการยืนยันการรับสินค้าหรือไม่?',
		'review_cancel'		=> 'คุณไม่ต้องรับสินค้า',

		'warning_receive_is_not_padding' => 'สถานะใบรับสินค้าต้องเป็น Padding เท่านั้น',
		'warning_receive_is_not_create' => 'สถานะใบรับสินค้าต้องเป็น Create เท่านั้น',

		'success_confirm' 	=> 'คุณต้องการรับสินค้าเข้าระบบหรือไม่?',
		'success_confirm_cancel' => 'คุณไม่ต้องการรับสินค้าเข้าระบบ',
		'status_success_message' => 'รับสินค้าเข้าระบบเรียบร้อย',
		'status_success_unsuccess_message'   => 'ไม่สามารถทำรายการได้ ลองใหม่อีกครั้ง',
	],
];