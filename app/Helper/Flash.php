<?php

namespace App\Helper;

class Flash{

	protected function create($title, $message, $level, $key = 'flash_message')
	{

		return session()->flash('flash_message', [
			'title' 	=> $title,
			'message' 	=> $message,
			'level' 	=> $level,
		]);
	}

	public function success($title, $message)
	{

		return $this->create($title, $message, 'success');
	}

	public function info($title, $message)
	{
		
		return $this->create($title, $message, 'info');
	}

	public function error($title, $message)
	{
		
		return $this->create($title, $message, 'error');
	}

	public function overlay($title, $message)
	{
		
		return $this->create($title, $message, 'info', 'flash_message');
	}

}