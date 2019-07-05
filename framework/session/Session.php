<?php

namespace Burger\Session;

class Session
{
	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	public static function has($name)
	{
		return (bool) isset($_SESSION[$name]);
	}

	public static function delete($name)
	{
		if (! self::has($name)) {
			return;
		}

		unset($_SESSION[$name]);

		return true;
	}

	public static function get($name)
	{
		return $_SESSION[$name];
	}

	public static function flash($key, $data = '')
	{
		if (self::has($key)) {
			$data = self::get($key);

			self::delete($key);

			return $data;
		}

		return self::put($key, $data);
	}
}
