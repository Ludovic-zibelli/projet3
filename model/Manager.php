<?php 

namespace openclassrooms\blog\model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO ('mysql:host=localhost;dbname=projet_3;charset=utf8', 'root', '');
		return $db;
	}
}