<?php 

use core\Main\SaveException as ParentException;

class MException extends ParentException
{
	function __construct($message, $code = 0, Exception $previous = Null)
	{
		return parent::__construct($message, $code, $previous);
	}
}