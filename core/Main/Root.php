<?php

namespace core\Main;

use core\Main\Token; 
use core\Main\Config; 
use core\Main\Request;
use core\Main\Redirect;

class Root 
{	
	private static $_root = false;	

	public static function post($to, $controller)
	{
		if (Request::exist('post')) {
			if (self::checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to || Request::get(Config::get('root/root_name')) == "/".$to) {
					self::$_root = true;
					callController($controller, new Request);	
				}
			}
		}
		return false;
	}

	public static function get($to, $controller)
	{
		if (Request::exist('get')) {
			if (Request::get(Config::get('root/root_name')) == $to || Request::get(Config::get('root/root_name')) == "/".$to) {
				self::$_root = true;
				callController($controller, new Request);
			}
		}
		return false;
	}
	public static function put($to, $controller)
	{
		if (Request::exist('put')) {
			if (self::checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to || Request::get(Config::get('root/root_name')) == "/".$to) {
					self::$_root = true;
					callController($controller, new Request);
	
				}
			}
		}
		return false;
	}
	public static function delete($from, $to)
	{
		if (Request::exist('delete')) {
			if (self::checkToken()) {
				if (Request::get(Config::get('root/root_name')) == $to || Request::get(Config::get('root/root_name')) == "/".$to) {
					self::$_root = true;
					callController($controller, new Request);
	
				}
			}	
		}
		return false;
	}
	public static function checkToken()
	{
		if (Token::check(Request::get(Config::get('session/token_name')))) {
			return true;
		}
		Redirect::to(403);
	}
	public static function none()
	{
		if (!self::$_root) {
			Redirect::to(404);
		}
		return false;
	} 
}