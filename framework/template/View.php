<?php

namespace Burger\Template;

class View
{
	public static function make($filename, $data = [])
	{
		$filename = str_replace('.', '/', $filename);

		extract($data);

		return require_once Template::render($filename);
	}
}
