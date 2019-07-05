<?php

namespace Burger\Http;

class Route
{
	protected static $router = null;

	public static function initialize($router)
	{
		self::$router = $router;
	}

	public static function __callStatic($method, $args)
	{
		return self::$router->$method(...$args);
	}
}
