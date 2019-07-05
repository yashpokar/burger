<?php

namespace Burger\Console;

class Command
{
	public function serve($port = 8000)
	{
		echo "Development server has been started @ http://localhost:{$port} \n";

		return exec("php -S localhost:{$port} -t public/");
	}
}
