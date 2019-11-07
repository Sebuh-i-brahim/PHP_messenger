<?php

require_once "../core/init.php";

use core\Main\Request;
use core\Main\Root;
use core\Main\Config;

Root::get('/', 'Controller@dump');

Root::get('/home', 'HomeController@lump');

Root::post('/login', "LoginController@pamp");
	

