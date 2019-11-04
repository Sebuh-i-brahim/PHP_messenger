<?php

namespace core\Main;

class SaveException
{
	private $_exception;
	
	function __construct($message, $code = 0, Exception $previous = Null)
	{
		parent::__construct($message, $code);

		$this->_exception = new Exception($message, $code)

		$err_msg = "Date: ".date("Y-m-d H:i:s"). "\r\n";

		$err_msg .= "File: ".$this->_exception->getFile(). "\r\n";

		$err_msg .= "Row: ".$this->_exception->getLine()."\r\n";

		$err_msg .= "Message: ".$this->_exception->getMessage(). "\r\n\r\n";

		$file = fopen('error.txt', 'abt');

		fwrite($file, $err_msg);

		fclose($file);

		return $this->_exception->getMessage();
	}

	static public function construct($message, $code = 0, Exception $previous = Null)
	{
		return self::__construct($message, $code = 0, $previous);
	}
}

?>