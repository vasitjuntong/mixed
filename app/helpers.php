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
				return '<span class="badge bg-info">create</span>';
			break;
		case 'padding':
				return '<span class="badge bg-warning">padding</span>';
			break;
		case 'success':
				return '<span class="badge bg-success">success</span>';
			break;
		case 'cancel':
				return '<span class="badge bg-danger">cancel</span>';
			break;
		
		default:
			
			break;
	}
}