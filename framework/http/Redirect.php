<?php

namespace Burger\Http;

use Burger\Session\Session;
use Burger\Template\View;

class Redirect
{
	protected $_location = '';

	public function to($location)
	{
		if (is_numeric($location)) {
			switch (404) {
				case 404:
					header('HTTP/1.0 404 Not Found');
					exit();
					break;
			}
		}

		$this->_location = $location;
	}

	public function __destruct()
	{
		if ($this->_location) {
			header("Location: {$this->_location}", true, 302);
			exit();

			// TODO :: do study about this not to sure how does it works
			ob_end_flush();
		}
	}

	public function back()
	{
		$this->_location = $_SERVER['HTTP_REFERER'];

		return $this;
	}

	public function with($key, $data)
	{
		Session::flash($key, $data);

		return $this;
	}

	public function withInputs($inputs)
	{
		Session::put('inputs', $inputs);

		return $this;
	}
}
