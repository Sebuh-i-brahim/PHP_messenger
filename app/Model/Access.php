<?php

namespace app\Model;

use app\Interface\Model;
use Devices;
use core\Main\SaveException;


class Access extends Devices
{
	private $_device,
			$_data,
			$_access = false;

	function __construct($id = null)
	{
		parent::__construct($id);
		if (parent::access()) {
			$this->_data = parent::db()->select('access', array())
		}
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

	public function delete()
	{

	}

	public function exist($data = [])
	{
		
	}
}