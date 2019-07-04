<?php

namespace Burger\Http;

class Request
{
	public static function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function uri()
	{
		return trim(
			parse_url(
				$_SERVER['REQUEST_URI'],
				PHP_URL_PATH
			),
			'/'
		);
	}
}
