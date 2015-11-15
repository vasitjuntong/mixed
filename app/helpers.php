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