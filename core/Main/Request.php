<?php

namespace core\Main;


class Request
{	

	public function __construct()
	{
		$this->property(self::all(strtolower($_SERVER["REQUEST_METHOD"])));
	}
	public function property($data = array())
	{
		foreach ($data as $key => $value) {
			if ($key != Config::get('session/token_name')) {
				$this->{$key} = $value;
			}
		}
	}
	public function data()
	{
		return $this->_data;
	}
	public static function exist($method, $request_name = null)
	{
		switch ($_SERVER["REQUEST_METHOD"]) {
			case 'GET':
				if ($request_name) {
					return (self::get($request_name) != '')? true : false;
				}
				return ($method == "get")? true : false;
				break;
			case 'POST':
				if ($request_name) {
					return (self::get($request_name) != '')? true : false;
				}
				if ($method == "put") {
					(Request::get("_method") == "put")? true : false;
				}elseif($method == "delete"){
					(Request::get("_method") == "delete")? true : false;
				}elseif ($method == "post") {
					return true;
				}else{
					return false;
				}
				break;
			default:
				# code...
				break;
		}
	}
	public static function get($item = null)
	{
		if (isset($_POST[$item])) {
			return $_POST[$item];
		}
		elseif (isset($_GET[$item])) {
			return $_GET[$item];
		}
		return '';
	}
	public static function all($method = null)
	{
		switch ($method) {
			case 'post':
				return $_POST;
				break;
			case 'get':
				return $_GET;
				break;
			default:
				return '';
				break;
		}
	}
}