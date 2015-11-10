<?php

function flash($title = null, $message = null)
{
	$flash = app('App\Helper\Flash');

	if(func_num_args() != 2){

		return $flash;
	}

	return $flash->info($title, $message);
}