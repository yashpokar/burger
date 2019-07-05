<?php

namespace Burger\Form;

use Burger\Form\Validators\BasicRulesTrait;

class Validate
{
	use BasicRulesTrait;

	protected $_errorHandler = null;

	protected $_messages = [
		'min' => ':field should have atleast :value characters.',
		'max' => ':field should not more than :value characters.',
		'unique' => ':field already exists.',
		'email' => 'Invalid email address.',
		'matches' => ':field does not match.',
		'required' => ':field is required.',
	];

	public function __construct(ErrorHandler $errorHandler)
	{
		$this->_errorHandler = $errorHandler;
	}

	public function data(array $source, array $fields = [])
	{
		foreach ($fields as $field => $rules) {
			$fieldName = ucfirst(implode(' ', explode('_', $field)));
			$rules = explode('|', $rules);

			foreach ($rules as $rule) {
				$value = $source[$field];
				$args = '';

				if (strpos($rule, ':') !== false) {
					[$rule, $args] = explode(':', $rule);
				}

				if (! $this->$rule($field, $value, ...explode(',', $args))) {
					$this->_errorHandler->push($field, str_replace([':field', ':value'], [$fieldName, $args], $this->_messages[$rule]));
				}
			}
		}

		return $this;
	}

	public function errors()
	{
		return $this->_errorHandler;
	}

	public function passes()
	{
		return ! $this->fails();
	}

	public function fails()
	{
		return $this->errors()->exists();
	}
}
