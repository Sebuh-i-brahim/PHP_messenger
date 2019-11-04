<?php

namespace app\Model;

use app\Interface\Model;
use Users;

class Contacts implements Model
{
	protected $_access = false,
			  $_db,
			  $_user,
			  $_data;
	function __construct($id = null)
	{
		$this->_user = new Users()
		if ($this->_user->islogged()) {
			$this->_access = true;
			$this->_db = $this->_user->db();
			
		}
		else{
			$this->_access = false;
		}
	}
	protected function select($id = null)
	{
		if ($id) {
			$this->_data = $this->db()->select(array("users", "user_contact", "contacts"), array("user_id" => $this->_user->data('user_id'), "contact_id" => $id));
		}else{
			$this->_data = $this->db()->select(array("users", "user_contact", "contacts"), array("user_id" => $this->_user->data('user_id')));
		}
	}
	public function get($id = null)
	{	
		if ($this->access()) {
			if ($id) {
				
			}else{
				$this->db()->select(array("users", "user_contact", "contacts"), array("user_id" => $this->_user->data('user_id')));
			}
		}
		return false;	
	}

	public function insert($data = [])
	{
		if ($this->access()) {
			if (!$this->_db->insert("contacts", $data)) {
				throw new Exception("There was an error creating an account");
			}
		}
	}
	public function update($data = [])
	{
		if ($this->access()) {
			$this->_db->update("contacts", $data, $id)
		}
	}

	public function exist($data = [])
	{
		
	}
	public function delete()
	{
		if ($this->access()) {
			$this->_db->delete("contacts", $data)
		}
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