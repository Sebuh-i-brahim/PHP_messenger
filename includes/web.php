<?php

require_once "../../core/init.php";

use core\Main\Request;
use core\Main\Root;
use core\Main\Config;

if (Request::exist('get','page')) {
	echo Config::get('root/root_name');
	//echo Request::get(Config::get('root/root_name'));
	Root::get('salam', 'Controller@dump');

	Root::post('adada', "Controller@dump");
	
}

