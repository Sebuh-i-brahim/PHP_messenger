<?php

namespace core\Main;

use core\Main\Config;

class SaveException extends \Exception 
{
	
	function __construct($message, $code = 0, Exception $previous = Null)
	{

		parent::__construct($message, $code, $previous);

		$error_log = Config::get("error/error_log");

		if($error_log == 1):

			$delete = false;

			$error_file_path = Config::get("error/error_file_path");

			if (file_exists($error_file_path)) {
				$filetime = date ("F d Y", filemtime($error_file_path));
				$now = date ("F d Y", time());
				if ($now != $filetime) {
					$delete = true;
				}
			}

			$err_msg  = "* * * * * * * * * * * * * * * * * * * * * * * * *\r\n";

			$err_msg .= ">>> Date: ".date("Y-m-d H:i:s"). "\r\n";

			$err_msg .= ">>> File: ".parent::getFile(). "\r\n";

			$err_msg .= ">>> Line: ".parent::getLine()."\r\n";

			$err_msg .= ">>> Message: ".parent::getMessage(). "\r\n";

			$err_msg .= "* * * * * * * * * * * * * * * * * * * * * * * * *\r\n\r\n";
			
			if ($delete) {
				$file = fopen($error_file_path, 'wbt');
			}else{
				$file = fopen($error_file_path, 'abt');
			}

			fwrite($file, $err_msg);

			fclose($file);

		endif;

		return parent;
	}
}

?>