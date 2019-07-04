<?php

namespace Burger\Database;

use PDO;
use PDOException;
use Burger\Config\Config;

class Connector
{
	public static function makeConnection()
	{
		$driver = Config::get('database.driver');
		$host = Config::get('database.host');
		$user = Config::get('database.user');
		$password = Config::get('database.password');
		$dbname = Config::get('database.dbname');
		$charset = Config::get('database.charset');
		$options = Config::get('database.options');

		try {
			$pdo = new PDO(
				"{$driver}:host={$host};charset={$charset};dbname={$dbname};",
				$user,
				$password,
				$options
			);

			$pdo->setAttribute(
				PDO::ATTR_ERRMODE,
				PDO::ERRMODE_EXCEPTION
			);

			return $pdo;
		} catch (PDOException $e) {
			// TODO :: Raise Database Connection Error Here
			die("Something went wrong with database");
		}
	}
}
