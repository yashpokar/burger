<?php

namespace App\Controllers;

class Controller
{
	public function validate(array $data = [])
	{
		$validation = (new \Burger\Form\Validate(new \Burger\Form\ErrorHandler()))->data($_POST, $data);

		if ($validation->fails()) {
			echo "errors found <br>";

			return (new \Burger\Http\Redirect())->back()
				// Serialize Error handler object and flash it
				->with('errors', serialize($validation->errors()));
		}
	}
}
