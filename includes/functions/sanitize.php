<?php

use core\Main\View as View;

function view($path, $data = array())
{
	return View::get($path, $data);
}

function makeController($path)
{
	return explode("@", $path);
}

function e($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function is_email($string)
{
	if (!filter_var($string, FILTER_VALIDATE_EMAIL)) {
		return false;
	}
	return true;
}


