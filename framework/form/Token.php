<?php

namespace Burger\Form;

use Burger\Config\Config;
use Burger\Session\Session;

class Token
{
	public static function generate()
	{
		return Session::put(Config::get('session.token_name'), md5(uniqid()));
	}

	public static function check($token)
	{
		$tokenName = Config::get('session.token_name');

		if (! Session::has($tokenName) || $token !== Session::get($tokenName)) {
			return false;
		}

		Session::delete($tokenName);
		return true;
	}
}
