<?php

namespace Burger\Http;

use Exception;

class Router
{
	protected $routes = [
		'GET' => [],
		'POST' => [],
	];

	public static function load($file)
	{
		$router = new static();

		require $file;

		return $router;
	}

	protected function register($method, $uri, $controller)
	{
		$uri = trim($uri, '/');

		return $this->routes[$method][$uri] = $controller;
	}

	public function get($uri, $controller)
	{
		return $this->register('GET', $uri, $controller);
	}

	public function post($uri, $controller)
	{
		return $this->register('POST', $uri, $controller);
	}

	public function direct($uri, $requestType)
	{
		if (! array_key_exists($uri, $this->routes[$requestType])) {
			throw new Exception("Route not defined to handle {$uri}");
		}

		return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
	}

	protected function callAction($controller, $action)
	{
		$controller = "\App\Controllers\\{$controller}";

		if (! class_exists($controller)) {
			throw new Exception("Controller does not exists ${$controller}");
		}

		$controller = new $controller();

		return $controller->$action();
	}
}
