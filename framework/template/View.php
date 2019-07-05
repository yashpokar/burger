<?php

namespace Burger\Template;

use Burger\Session\Session;

class View
{
	public static function make($filename, $data = [])
	{
		// TODO :: do study about this not to sure how does it works
		ob_start();

		$errors = new \Burger\Form\ErrorHandler();

		if (Session::has('errors')) {
			$errors = unserialize(Session::flash('errors'));
		}

		$filename = str_replace('.', '/', $filename);

		extract($data);

		return require_once Template::render($filename);
	}
}
