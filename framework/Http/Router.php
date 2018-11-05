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

	protected function register($requestType, $uri, $controller)
	{
		$uri = trim($uri, '/');

		return $this->routes[$requestType][$uri] = $controller;
	}

	public function get($uri, $controller)
	{
		return $this->register('GET', $uri, $controller);
	}

	public function post($uri, $controller)
	{
		return $this->register('GET', $uri, $controller);
	}

	public function direct($uri, $requestType)
	{
		return $this->callAction(...explode('@', $this->routes[$requestType][$uri]));
	}

	protected function callAction($controller, $action)
	{
		$controller = "App\\Controllers\\{$controller}";

		$controller = new $controller();

		if (! method_exists($controller, $action)) {
			throw new Exception("Method not exists {$action}");
		}

		return $controller->$action();
	}
}
