<?php

require_once "../core/init.php";

use core\Main\Session;
use core\Main\Redirect;


if (Session::exist('view')) {
	require_once "view/".Session::flash('view').".php";
}else{
	Redirect::to(404);
}