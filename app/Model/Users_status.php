<?php

namespace app\Model;

use Users; 
use app\Interface\Model;
use core\Main\SaveException;


class Users_status extends Users implements Model
{
	private $_access = false;
			$_data = null;
	function __construct($id = null)
	{
		parent::__construct();
		if (parent::islogged()) {
			$this->_access = true;
			if ($id) {
				$this->_data = parent::db()->select('users_status', array("user_id" => $id))->first();
			}else{
				$this->_data = parent::db()->select('users_status', array("user_id" => parent::data('user_id')))->first();
				if (!$this->exist()) {
					$this->insert(array(
						'user_id' => parent::data('user_id'),
						'status' => "1"
					));
				}
			}
		}
	}

	public function get($column = null)
	{
		if ($column) {
			return $this->_data->$column;
		}
		return $this->_data;
	}

	public function insert($data = [])
	{
		if ($this->_access) {
			if(!parent::db()->insert('users_status', $data)){
				throw new SaveException("There was a problem inserting status!");
			}
		}
	}
	
	public function update($data = [])
	{
		if ($this->_access) {
			if (!parent::db()->update('users_status', $data, parent::data('user_id'), 'user_id')) {
				throw new SaveException("There was a problem updating status!");
			}
		}
	}
	public function exist($key = null)
	{
		return (empty($this->get($key)))? false : true;
	}
}