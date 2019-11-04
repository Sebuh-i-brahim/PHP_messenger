<?php

namespace core\Main;

/**
 * 
 */
use Config;

class DB
{
	private static $_connect = null;
	private $_pdo,
			$_query,
			$_error = false,
			$_results,
			$_count = 0;
	public function __construct()
	{
		try {
			$server = Config::get('mysql/host');
			$dbname = Config::get('mysql/dbname');
			$this->_pdo = new PDO("servername={$server};dbname={$dbname}",Config::get('mysql/username'),Config::get('mysql/password'));
		} catch (PDOException $e) {
			die($e->getMessage());
		}
	}
	public static function Connect()
	{
		if (!isset(self::$_connect)) {
			self::$_connect = new DB();
		}
		return self::$_connect;
	}
	public function query($sql, $data = array())
	{
		if ($this->_query = $this->_pdo->prepare($sql)) {
			$x = 1;
			if (count($data)) {
				foreach ($data as $field) {
					$this->_query->bindValue($x, $field);
					$x++;
				}
			}
			if ($this->_query->excute()) {
				$this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}else{
				$this->_error = true;
			}
		}
		return $this;
	}
	public function select($table, $data = [], $column = "*", $limit = "25", $equal = "=")
	{
		if (is_array($table)) {
			$sql = "SELECT {$column}".$this->join($table, $data);
		}else{
			if (empty($data)) {
				$sql = "SELECT {$column} FROM {$table} LIMIT {$limit}";
			}
			else{
				$sql = "SELECT {$column} FROM {$table} ".$this->sql($data, $equal);
			}
		}
		if(!$this->query($sql, $data)->error()){
		 	return $this;
		}

		return false;
	}
	public function insert($table, $data = array())
	{
		if(empty($data)){
			return false;
		}
		else{
			if (count($data)) {
				$keys = implode('`, `',array_keys($data));
				$value = '';
				$z = 1; 
				foreach ($data as $was) {
					$value.= "?";
					if ($z<count($data)) {
						$value .= ", ";
					}
					$z++;
				}
				$sql = "INSERT INTO {$table} (`{$keys}`) VALUES ({$value})";
				if(!$this->query($sql, $data)->error()){
				 	return $this;
				}
			}
		}
		return false;
	}

	public function update($table, $data = array(), $id = null)
	{
		$set = "";
		$x = 1;
		$tb_id = $this->findIdName($table);
		foreach ($data as $key => $value) {
			$set .= "{$key} = ?";
			if ($x < count($data)) {
				$set .= ", ";
			}
			$x++;
		}

		$sql = "UPDATE {$table} SET {$set} WHERE {$tb_id} = {$id}";

		if(!$this->query($sql, $data)->error()){
		 	return $this;
		}
		return false;
	}

	public function delete($table, $data = array())
	{

		if (is_array($table)) {
			if (empty($data)) {
				return false;
			}else{
				$sql = "DELETE A".$this->join($table, $data);
			}
			
		}else{
			if (empty($data)) {
				return false;
			}
			else{
				$sql = "DELETE FROM {$table} ".$this->sql($data);
			}
		}
		
		if(!$this->query($sql, $data)->error()){
		 	return $this;
		}
		return false;
	}
	private function join($table = array(), $data = array())
	{
		if (count($table) == 3) {
			$id1 = $this->findIdName($table[0]);
			$id2 = $this->findIdName($table[2]);
			$sql = " FROM {$table[0]} AS A INNER JOIN {$table[1]} AS B ON (A.{$id1} = B.{$id1}) INNER JOIN {$table[2]} AS C ON (B.{$id2} = C.{$id2}) ";
			if (empty(!$data)) {
				$data_key = array_keys($data);
				if (count($data) = 2) {
					$sql .= $this->sql(array("A.{$data_key[0]}" => $data[$data_key[0]], "C.{$data_key[1]}" => $data[$data_key[1]]));
				}elseif (count($data) = 1) {
					$sql .= $this->sql(array("A.{$data_key[0]}" => $data[$data_key[0]]));
				}
				
			}else{
				$sql .= "LIMIT 25";
			}
			return $sql;
		}elseif (count($table) == 2) {
			$id1 = $this->findIdName($table[0]);
			$sql = " FROM {$table[0]} AS A INNER JOIN {$table[1]} AS B ON (A.{$id1} = B.{$id1}) ";
			if (empty(!$data)) {
				if (count($data) = 2) {
					$sql .= $this->sql(array("A.{$data_key[0]}" => $data[$data_key[0]], "B.{$data_key[1]}" => $data[$data_key[1]]));
				}elseif (count($data) = 1) {
					$sql .= $this->sql(array("A.{$data_key[0]}" => $data[$data_key[0]]));
				}
			}else{
				$sql .= "LIMIT 25";
			}
			return $sql;
		}
		return false;
	}

	public function search($table, $data = array(), $empty = false, $column = "*", $limit = "10")
	{
		if (empty($data)) {
			$sql = ($empty)? "SELECT {$column} FROM {$table} LIMIT {$limit}" : return false;
		}else{
			foreach ($data as $field) {
				$field = "%{$field}%";
			}
			$sql = "SELECT {$column} FROM {$table} ".$this->sql($data, "LIKE");
		}
		if (!$this->query($sql, $data)->error()) {
			return $this;
		}
		return false;
	}
	public function error()
	{
		return $this->_error;
	}

	public function result()
	{
		return $this->_results; 
	}

	public function first($column = null)
	{
		return (empty($column))? $this->_results[0] : $this->_results[0]->$column;
	}
	public function count()
	{
		return $this->_count;
	}
	public function findIdName($table)
	{
		foreach ($this->query("SHOW COLUMNS FROM {$table}")->result() as $col_pre) {
			foreach ($col_pre as $key) {
				if ($key == "PRI") {
					return $col_pre->Field;
				}
			}
		}
	}
	public function sql($data, $equal = "=")
	{
		$sql1 = "WHERE ";
		$sql2 = "";
		$d = 0;
		if (count($data) < 3) {
			foreach ($data as $col => $val) { 
				for ($l=0; $l < count($data); $l++) { 
					if (2**$l == $d+1) {
				
							$sql2 = "".$sql2;
						
					}
				}
				$sql2 .= "{$col} {$equal} ?";

				for ($g=0; $g < count($data); $g++) { 
					if (2**$g == $d+1) {
						if ($d < count($data)-1) {
							$sql2 = $sql2." AND ";
						}
						else{
							$sql2.= "";
						}
					}
				}
				$d++;
			}
		}		
		return $sql1.$sql2;
	}	
}