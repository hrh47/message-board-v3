<?php

namespace App\Core\Database;

use \PDO;

class Connection
{
	public static function make($config)
	{
		try {
			return new PDO(
				$config['connection'] . ':host=' . $config['host'] . ';dbname=' . $config['name'],
				$config['username'],
				$config['password'],
				$config['options']
			);
		} catch (PDOException $e) {
			die('Database error');
		}
	}
}