<?php

namespace Burger\Database;

use Exception;
use Burger\Database\DB;

abstract class Model
{
	public static function __callStatic($methodName, $args)
	{
		$model = get_called_class();

		if (! isset($model::$table)) {
			throw new Exception("Table name is required in model class.");
		}

		return DB::table(
			$model::$table
		)->$methodName(...$args);
	}
}
