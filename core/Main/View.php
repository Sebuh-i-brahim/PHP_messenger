<?php

namespace core\Main;

use core\Main\Redirect;

use core\Main\Session;

class View
{
	public static function get($view, $data = array())
	{
		if (!empty($data)) {
			Session::put("data", $data);
		}
		Session::put("view", $view);

		return require_once "../public/index.php";
	}
}