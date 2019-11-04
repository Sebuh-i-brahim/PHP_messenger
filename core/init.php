<?php



$GLOBALS['config'] = json_decode(file_get_contents("../../settings.json"), true);

spl_autoload_register(
	function($dir){
		require_once "../../".$dir.".php";
	}
);

require_once "../../includes/functions/sanitize.php";

session_start();
