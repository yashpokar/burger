<?php

use Burger\Http\Router;
use Burger\Http\Request;
use Burger\Http\Response;

require_once __DIR__ . '/../bootstrap/app.php';

$response = Router::load(__DIR__ . '/../routes/web.php')
	->direct(
		Request::uri(),
		Request::method()
	);

echo Response::json($response);
