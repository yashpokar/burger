<?php

if (! function_exists('dd')) {
	echo "<pre>";

	function dd(...$vars) {
		foreach ($vars as $var) {
			var_dump($var);
		}
	}

	echo "</pre>";
}

if (! function_exists('config')) {
	function config($accessor) {
		return Burger\Config\Config::get($accessor);
	}
}

if (! function_exists('view')) {
	function view($filename, array $data = []) {
		return Burger\Template\View::make($filename, $data);
	}
}
