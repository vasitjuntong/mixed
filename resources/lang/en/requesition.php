<?php

return [
    'label'       => [
        'name'        => 'Requisition',
        'create'      => 'Create Requisition',
        'update'      => 'Update Requisition',
        'delete'      => 'Delete Requisition',
        'empty_data'  => 'Requisition not found',
        'select'      => 'Select Project',
        'add_product' => 'Add Product',

        'new_requesition' => 'New Requisition',
        'movement'    => 'Movement Requisition',
    ],
    'buttons'     => [
        'create'          => 'Create',
        'update'          => 'Update',
        'delete'          => 'Delete',
        'search'          => 'Search Requisition',
        'refresh'         => 'Refresh',
        'excel'           => 'Excel',
        'upload_excel'    => 'Upload Excel',
        'add_product'     => 'Add Product',
        'back_to_requesition' => 'Back To Requisition',
        'confirm_requesition' => 'Confirm Requisition',
        'process_success' => 'Process Success',
        'process_padding' => 'Process Padding',
        'success_status'  => 'Success Status',
        'cancel_status'   => 'Cancel Status',
    ],
    'attributes'  => [
        'document_no'  => 'DN.',
        'user_id'      => 'Create By',
        'project_id'   => 'Project',
        'project_code' => 'Project',
        'site_id'      => 'Site ID',
        'site_name'    => 'Site Name',
        'receive_date' => 'Receive Date',
        'receive_company_name'    => 'Receive Compay',
        'receive_contact_name'    => 'Contact Name',
        'receive_phone'           => 'Contact Phone',
        'create_by'    => 'Create By',
        'status'       => 'Status',
        'created_at'   => 'Date',
        'updated_at'   => 'Update',
    ],
    'form_search' => [
        'document_no'      => 'DN',
        'mix_no'           => 'Mix NO.',
        'product_code'     => 'Product Code',
        'site_id'          => 'Site ID',
        'site_name'        => 'Site Name',
        'project'          => 'Project',
        'create_by'        => 'Create By',
        'item_status'      => 'Item Status',
        'created_at_start' => 'Create Start',
        'created_at_end'   => 'Create End',
    ],
    'message_alert' => [
        'create_success'    => 'Create product is successfully.',
        'update_success'    => 'Update product is successfully.',
        'delete_success'    => 'Delete product is successfully.',
        'delete_unsuccess'  => 'Can\'t delete product, Product is proccesses.',
        'delete_confirm'    => 'Are you sure for delete product?',
        'cancel_message'    => 'Cancel for delete product.',

        'review_confirm' => 'คุณต้องการยืนยันการเบิกสินค้าหรือไม่?',
        'review_cancel'  => 'คุณไม่ต้องการเบิกสินค้า',

        'warning_is_not_padding' => 'Requisition status padding only.',
        'warning_is_not_create'  => 'Requisition status create only.',
        'warning_product_is_exists'      => 'Product already exists.',

        'success_confirm'                  => 'Are you sure success items?',
        'success_confirm_cancel'           => 'Cancel success items.',
        'cancel_confirm'                   => 'Are you sure cancel items?',
        'cancel_confirm_cancel'            => 'Cancel items.',
        'status_success_message'           => 'Item status is success.',
        'status_success_unsuccess_message' => 'Someting is wrong. Please try again.',
        'status_padding_message'           => 'Item status is Padding',
        'status_padding_unsuccess_message' => 'Someting is wrong. Please try again.',
        'status_cancel_message'            => 'Items status is cancel.',
        'requesition_error_case_item_not_enouge' => 'Requisition is no success. Product not enouge.',
    ],
];