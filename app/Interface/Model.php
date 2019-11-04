<?php

namespace app\Model;

interface Model
{
	public function get($data = []);

	public function insert($data = []);

	public function update($data = []);

	public function exist($key = null);

}