<?php

namespace App\Controllers;

use Exception;
use Burger\Config\Config;

class Controller
{
	/**
	 * Created alias for validate data through controller
	 * @param  array  $data
	 * @return mixed
	 */
	public function validate(array $data = [])
	{
		$validation = (new \Burger\Form\Validate(
			new \Burger\Form\ErrorHandler()
		))->data($_POST, $data);

		// TODO :: this shoud be a middleware
		if (! \Burger\Form\Token::check(
			\Burger\Form\Input::get(Config::get('session.token_name'))
		)) {

			// TODO :: turn this into a custom exception
			throw new Exception("CSRF token miss match.");

			return Redirect::to(404);
		}

		// Throw user back when validation fails
		if ($validation->fails()) {
			echo "errors found <br>";

			return (new \Burger\Http\Redirect())->back()
				// Serialize Error handler object and flash it
				->with('errors', serialize($validation->errors()))
				->withInputs($_POST);
		}

		return true;
	}
}
