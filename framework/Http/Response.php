<?php

namespace Burger\Http;

class Response
{
	public static function json($response, $status_code = 200)
	{
		http_response_code($status_code);

		return json_encode($response);
	}
}
