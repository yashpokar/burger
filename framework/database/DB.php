<?php

namespace Burger\Database;

use Exception;

class DB
{
	/**
	 * Just an alis so that developer can use instance method
	 * as static one
	 * @param  array $args
	 * @return \Burger\Database\QueryBuilder::table
	 */
	public static function table(...$args)
	{
		return QueryBuilder::getConnection()
			->table(...$args);
	}
}
