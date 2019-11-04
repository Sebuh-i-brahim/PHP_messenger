<?php

namespace core\Main;

/**
 * 
 */
use Redirect;

use Session;

class View
{
	public static function get($view, $data = [])
	{
		if (!empty($data)) {
			Session::put("data", $data);
		}
		Session::flash("view", $view);

		Redirect::to("view/view.php");
	}
}