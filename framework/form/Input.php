<?php

namespace Burger\Form;

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
		if (isset($_POST[$item])) {
			return $_POST[$item];
		} else if (isset($_GET[$item])) {
			return $_GET[$item];
		}

		return '';
	}
}
