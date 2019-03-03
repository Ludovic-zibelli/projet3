<?php 

namespace openclassrooms\blog\model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO ('mysql:host=db775665650.hosting-data.io;dbname=db775665650;charset=utf8', 'dbo775665650', 'Projet3%');
		return $db;
	}
}