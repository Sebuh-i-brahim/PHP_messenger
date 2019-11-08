<?php

require_once "../core/init.php";

use core\Main\Root;

Root::get('/', 'Controller@dump');

Root::get('/home', 'HomeController@lump');

Root::post('/login', "LoginController@login");

Root::none();