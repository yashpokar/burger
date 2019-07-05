<?php

namespace Burger\Form;

class ErrorHandler
{
	protected $_errors = [];

	public function push($key, $error)
	{
		return $this->_errors[$key][] = $error;
	}

	public function has($key)
	{
		return isset($this->_errors[$key]);
	}

	public function all($key = '')
	{
		if ($key) {
			return $this->_errors[$key];
		}

		return $this->_errors;
	}

	public function exists()
	{
		return ! empty($this->_errors);
	}

	public function first($key = '')
	{
		if ($key) {
			return $this->all($key)[0];
		}

		return $this->all()[0];
	}
}
