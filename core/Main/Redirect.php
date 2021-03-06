<?php

namespace core\Main;

class Redirect
{
	public static function to($location = null)
	{
		if ($location) {
			if (is_numeric($location)) {
				switch ($location) {
					case 404:
						header("HTTP/1.0 404 Not Found");
						include '../includes/errors/404.php';
						exit();
						break;
					case 403:
						header("HTTP/1.1 403 Forbidden");
						include '../includes/errors/403.php';
						exit();
						break;
					default:
						# code...
						break;
				}
			}
			header("Location: ".$location);
			exit();
		}
	}
}