<?php

namespace Burger\Form\Validators;

trait BasicRulesTrait
{
	public function min($value, $atleast)
	{
		return strlen($value) >= $atleast;
	}

	public function max($value, $atmost)
	{
		return strlen($value) <= $atmost;
	}

	public function unique($value, $table)
	{
		return true;
	}

	public function email($value)
	{
		return true;
	}

	public function matches($value, $to)
	{
		return true;
	}
}
