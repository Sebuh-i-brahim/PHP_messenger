<?php

use core\Main\View;

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

function array_row($data = array(), $field = array())
{
	$column = array_column($data, array_keys($field)[0]);
	$found_key = array_search($field[array_keys($field)[0]], $column);
	return ($found_key)? $data[$found_key] : false;
}


