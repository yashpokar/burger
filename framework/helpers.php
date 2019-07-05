<?php

if (! function_exists('old')) {
	function old(...$args) {
		return \Burger\Form\Input::old(...$args);
	}
}

if (! function_exists('flash')) {
	function flash(...$args) {
		return \Burger\Session\Session::flash(...$args);
	}
}

if (! function_exists('input')) {
	function input($field) {
		return \Burger\Form\Input::get($field);
	}
}

if (! function_exists('dd')) {
	function dd(...$vars) {
		foreach ($vars as $var) {
			var_dump($var);
		}

		die();
	}
}

if (! function_exists('config')) {
	function config(...$args) {
		return \Burger\Config\Config::get(...$args);
	}
}

if (! function_exists('view')) {
	function view(...$args) {
		return \Burger\Template\View::make(...$args);
	}
}

if (! function_exists('escape')) {
	function escape($string) {
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}
