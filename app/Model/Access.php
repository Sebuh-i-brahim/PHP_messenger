<?php

namespace app\Model;

use Devices, Model;

class Access extends Devices implements Model
{
	private $_user,
			$_device,
			$_db,
			$_data,
			$_access;

	function __construct()
	{
		parent::__construct();
	}

	public function get($data = [])
	{

	}

	public function insert($data = [])
	{

	}
	public function update($data = [])
	{

	}

	public function exist($data = [])
	{
		
	}
}