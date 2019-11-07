<?php

namespace app\Model;

use Messages, 
use app\Interface\Model;
use core\Main\SaveException;


class Deleted_messages extends Messages implements Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function get($data = [])
	{

	}

	public function insert($data = [])
	{

	}
	
	public function update($data = [])
	{

	}

	public function exist($data = [])
	{
		
	}
}