<?php

namespace Burger\Form;

use Burger\Session\Session;

class Input
{
	public static function exists($type = 'POST')
	{
		switch (strtoupper($type)) {
			case 'POST':
				return ! empty($_POST) ? true : false;
				break;

			case 'GET':
				return ! empty($_GET) ? true : false;
				break;

			default:
				return false;
				break;
		}
	}

	public static function get($field)
	{
		if (isset($_POST[$field])) {
			return $_POST[$field];
		} else if (isset($_GET[$field])) {
			return $_GET[$field];
		}

		return '';
	}

	public static function old($field)
	{
		if (Session::has('inputs')) {
			return Session::get('inputs')[$field];
		}

		return false;
	}
}
