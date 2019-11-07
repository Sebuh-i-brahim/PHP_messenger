<?php

namespace app\Model;

use app\Interface\Model;
use Users;
use core\Main\SaveException;

class Contacts implements Model
{
	protected $_access = false,
			  $_db,
			  $_user,
			  $_data = array();
	function __construct($id = null)
	{
		$this->_user = new Users()
		if ($this->_user->islogged()) {
			$this->_access = true;
			$this->_db = $this->_user->db();
			if ($id) {
				$this->_data = $this->db()->select(array("users", "user_contact", "contacts"), array("user_id" => $this->_user->data('user_id'), "contact_id" => $id));
			}else{
				$this->_data = $this->db()->select(array("users", "user_contact", "contacts"), array("user_id" => $this->_user->data('user_id')));
			}
		}
		else{
			$this->_access = false;
		}
	}
	public function get($id = null)
	{	
		if ($this->access()) {
			if ($id) {
				if (is_array($id)) {
					return array_row($this->_data, $id);
				}else{
					return array_row($this->_data, array("contact_id" => $id));
				}
			}else{
				return $this->_data;
			}
		}
		return false;	
	}

	public function insert($data = [])
	{
		if ($this->access()) {
			if (!$this->_db->insert("contacts", $data)) {
				throw new SaveException("There was an error creating new Contact");
			}else{
				if (!$this->_db->insert("user_contact", array("user_id" => $this->_user->data('user_id'), "contact_id" => $this->db()->lastID()))) {
					throw new SaveException("There was an error creating new Contact");
				}
			}	
		}
	}
	public function update($data = [])
	{
		if ($this->access()) {
			if(!$this->_db->update("contacts", $data, $this->_user->data('user_id'), array("user_id", "person_id"))){
				throw new SaveException("There was an error updating Contact");
			}
		}
	}

	public function exist($data = [])
	{
		return (empty($this->data()))? false: true;
	}
	public function delete($id)
	{
		if ($this->access()) {
			if($this->_db->delete(array("contacts", "user_contact", "users"), array("user_id" => $id, "person_id" => $id), "=", "OR")){
				throw new SaveException("There was an error removing Contact from Friends");
			}
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