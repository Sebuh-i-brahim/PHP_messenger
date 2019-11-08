<?php

namespace app\Controller;

use app\Controller\Controller;
use core\Main\Request;

class LoginController extends Controller
{
	public static function login($request = array())
	{
		return view('login', $request);
	}
}