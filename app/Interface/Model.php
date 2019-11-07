<?php

namespace app\Model;

interface Model
{

	public function __construct($id = null);

	public function get($column = null);

	public function insert($data = []);

	public function update($data = []);

	public function exist($key = null);

}