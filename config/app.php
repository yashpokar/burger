<?php

return [

	'name' => 'Burger',

	'debug' => true,

	'mode' => 'local',

	'timezone' => 'UTC',

	'middlewares' => [
		\App\Middlewares\VerifyCSRFTokenMiddleware::class,
	],

];
