<?php

namespace core\Main;

use core\Main\Token, core\Main\Config, core\Main\Request;

class Root 
{		
	public static function post($to, $controller)
	{
		if (Request::exist('post')) {
			if ($this->checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to) {
					$name = makeController($controller);
					call_user_func_array(array('app\\Controller\\'.$name[0], $name[1]), Request::all());	
				}
			}
		}
		return false;
	}

	public static function get($to, $controller)
	{
		if (Request::exist('get')) {
			if (Request::get(Config::get('root/root_name')) == $to) {
				$name = makeController($controller);
				call_user_func_array(array('app\\Controller\\'.$name[0], $name[1]), Request::all());
			}
		}
		return false;
	}
	public static function put($to, $controller)
	{
		if (Request::exist('put')) {
			if ($this->checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to) {
					$name = makeController($controller);
					call_user_func_array(array('app\\Controller\\'.$name[0], $name[1]), Request::all());	
				}
			}
		}
		return false;
	}
	public static function delete($from, $to)
	{
		if (Request::exist('delete')) {
			if ($this->checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to) {
					$name = makeController($controller);
					call_user_func_array(array('app\\Controller\\'.$name[0], $name[1]), Request::all());	
				}
			}	
		}
		return false;
	}
	public static function checkToken()
	{
		return Token::check(Request::get('_token'));
	}
}