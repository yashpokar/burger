<?php

namespace Burger\Template;

use Burger\Session\Session;

class View
{
	/**
	 * Build user templates and make it awailable to the user
	 * @param  String $filename
	 * @param  array  $data
	 * @return String
	 */
	public static function make($filename, $data = [])
	{
		// TODO :: do study about this not to sure how does it works
		ob_start();

		// Made $errors awailable if it does not exists in session
			// so that functionality won't break
		$errors = new \Burger\Form\ErrorHandler();

		if (Session::has('errors')) {
			// Unserializing it because the object is serialized
			$errors = unserialize(Session::flash('errors'));
		}

		$filename = str_replace('.', '/', $filename);

		extract($data);

		return require_once (new Template($filename))->render();
	}
}
