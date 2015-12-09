<?php

function flash($title = null, $message = null)
{
	$flash = app('App\Helper\Flash');

	if(func_num_args() != 2){

		return $flash;
	}

	return $flash->info($title, $message);
}

function urlActive($menu)
{
	$url = app('App\Helper\UrlActive');

	if($menu == 'component'){
		return $url->component();
	}

	if($menu == 'setting'){
		return $url->settings();
	}
}

function activeMenu($menus = array())
{
	$status = false;

	foreach($menus as $menu){
		if(request()->is($menu)){
			$status = true;
		}
	}

	return $status;
}

function statusHtmlRender($status)
{
	switch ($status) {
		case 'create':
				return '<label class="label label-info">create</label>';
			break;
		case 'padding':
				return '<label class="label label-warning">padding</label>';
			break;
		case 'success':
				return '<label class="label label-success">success</label>';
			break;
		case 'cancel':
				return '<label class="label label-danger">cancel</label>';
			break;
		
		default:
			
			break;
	}
}

function hasRole($menu)
{
	if($menu == 'component'){
		$receive = Auth::user()->hasRole('manager_receive');
		$requesition = Auth::user()->hasRole('manager_requesition');
		$product_list = Auth::user()->hasRole('manager_product_list');

		if($receive || $requesition || $product_list){

			return true;
		}else{

			return false;
		}
	}

	if($menu == 'setting'){
		$product = Auth::user()->hasRole('manager_product');
		$product_type = Auth::user()->hasRole('manager_product_type');
		$unit = Auth::user()->hasRole('manager_unit');
		$location = Auth::user()->hasRole('manager_location');
		$project = Auth::user()->hasRole('manager_project');
		$user = Auth::user()->hasRole('manager_user');

		if($product || $product_type || $unit || $location || $project || $user) {
			return true;
		}else{
			return false;
		}

	}
}

function changeFormatDateToDb($date, $spec = '/')
{
	list($d, $m, $y) = explode($spec, $date);

	return "{$y}-{$m}-{$d}";
}





