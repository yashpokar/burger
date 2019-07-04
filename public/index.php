<?php

use Burger\Http\Router;
use Burger\Http\Request;

require __DIR__ . '/../bootstrap/app.php';

try {
	Router::load(
		__DIR__ . '/../routes/web.php'
	)
	->direct(
		Request::uri(),
		Request::method()
	);
} catch (Exception $e) {
	die($e);
}
