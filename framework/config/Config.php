<?php

namespace Burger\Config;

class Config
{
	protected static $delimiter = '.';

	/**
	 * Retrive config from config file
	 * @param  string $accessor
	 * @return mixed
	 */
	public static function get($accessor)
	{
		$path = explode(self::$delimiter, $accessor);

		$config = require __DIR__ . "/../../config/{$path[0]}.php";

		unset($path[0]);

		foreach ($path as $bit) {
			if (isset($config[$bit])) {
				$config = $config[$bit];
			}
		}

		return $config;
	}
}
