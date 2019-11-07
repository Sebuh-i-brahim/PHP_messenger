<?php

namespace app\Model;

use Users; 
use core\Main\SaveException;

class Devices extends Users
{
	private $_access = false,
			$_db = null,
			$_parent = null,
			$_data = null;
	function __construct()
	{
		parent::__construct();
		if (parent::islogged()) {
			$this->_access = true;
			$this->_db = parent::db();
			$this->_data = $this->_db->select('devices', array('user_id' => parent::data('user_id')));
			$this->_parent = parent::data();
		}
	}

	public function get($dvcid = null)
	{
		if ($dvcid) {
			return array_row($this->_data, array('dvcself_id' => $dvcid));
		}
		return $this->_data;
	}

	public function insert($data = [])
	{
		if ($this->access()) {
			if (!$this->_db->insert('devices', $data)) {
				throw new SaveException("There was a problem inserting data to 'devices' table!");	
			}	
		}
	}

	public function exist($key = null)
	{
		return (empty($this->get($key)))? false : true;
	}

	public function access()
	{
		return $this->_access;
	}
	public function db()
	{
		return $this->_db;
	}
}