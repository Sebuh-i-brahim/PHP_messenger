<?php

namespace app\Controller;

use app\Controller\Controller;

class HomeController extends Controller
{
	public static function lump()
	{
		echo "++++++++++++++++++++++=====_______+-=-=-=-=-=-+_=_+_-=-=-++++-==___++_--------+_+_+_=_+";
		return view('home');
	}
}