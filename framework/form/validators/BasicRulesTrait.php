<?php

namespace Burger\Form\Validators;

use \Burger\Database\DB;
use \Burger\Form\Input;

trait BasicRulesTrait
{
	public function required($field, $value)
	{
		return (bool) trim($value);
	}

	public function min($field, $value, $atleast)
	{
		return strlen($value) >= $atleast;
	}

	public function max($field, $value, $atmost)
	{
		return strlen($value) <= $atmost;
	}

	public function unique($field, $value, $table)
	{
		return ! DB::table($table)
			->where($field, $value)
			->exists();
	}

	public function email($field, $value)
	{
		return filter_var($value, FILTER_VALIDATE_EMAIL);
	}

	public function matches($field, $value, $to)
	{
		return Input::get($to) === $value;
	}
}
