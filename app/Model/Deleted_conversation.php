<?php

namespace app\Model;

use Conversation; 
use app\Interface\Model;
use core\Main\SaveException;


class Deleted_conversation extends Conversation implements Model
{
	
	function __construct(argument)
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