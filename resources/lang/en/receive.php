<?php 

return [
	'label' => [
		'name' 			=> 'Receive',
		'create' 		=> 'รับสินค้าเข้าระบบ',
		'update' 		=> 'Update Receive',
		'delete' 		=> 'Delete Receive',
		'empty_data' 	=> 'Receive not found',
		'select'		=> 'Select Project',
		'add_product'	=> 'Add Product',

		'new_receive' 	=> 'New Receive',
		'movement' 		=> 'Movement Receive',
	],
	'buttons' => [
		'create' => 'Create',
		'update' => 'Update',
		'delete' => 'Delete',
		'search' => 'Search Receive',
		'refresh' => 'Refresh',
		'excel' => 'Excel',
		'add_product' => 'Add Product',
		'back_to_receive' => 'Back To Receive',
		'confirm_receive' => 'Confirm Receive',
		'process_success' => 'Process Success',
		'process_padding' => 'Process Padding',
	],
	'attributes' => [
		'document_no' 	=> 'DN.',
		'po_no' 	  	=> 'PO. NO.',
		'ref_no' 		=> 'Referrence NO.',
		'project_id' 	=> 'Project',
		'project_code' 	=> 'Project',
		'status' 		=> 'Status',
		'remark'		=> 'Remark',
		'created_at'	=> 'Date',
		'updated_at'	=> 'Update',

		'stock' 		=> 'Stock',
		'create_by'		=> 'Create By',
		'success_status' => 'Action'
	],
	'form_search' => [
		'document_no' 	=> 'DN',
		'po_no' 	  	=> 'PO NO',
		'ref_no' 		=> 'Referrence NO',
		'project' 		=> 'Project',
		'create_by' 	=> 'Create By',
		'created_at_start' => 'Create Start',
		'created_at_end' => 'Create End',
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

		'warning_receive_is_not_padding' => 'Receive status padding only.',
		'warning_receive_is_not_create' => 'Receive status create only.',
		'warning_product_is_exists' => 'Product already exists.',

		'success_confirm' 	=> 'คุณต้องการรับสินค้าเข้าระบบหรือไม่?',
		'success_confirm_cancel' => 'คุณไม่ต้องการรับสินค้าเข้าระบบ',
		'status_success_message' => 'รับสินค้าเข้าระบบเรียบร้อย',
		'status_success_unsuccess_message'   => 'ไม่สามารถทำรายการได้ ลองใหม่อีกครั้ง',
		'status_padding_message' => 'ใบรับสินค้าอยู่ในสถานะ Padding',
		'status_padding_unsuccess_message'   => 'ไม่สามารถทำรายการได้ ลองใหม่อีกครั้ง',
	],
];