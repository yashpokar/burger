<?php

namespace App\Controllers;

use Burger\Database\DB;
use App\Models\User;

class AuthController extends Controller
{
	public function registerForm()
	{
		return view('auth.register');
	}

	public function register()
	{
		$this->validate([
			'first_name' => 'required|min:2|max:20',
			'last_name' => 'required|min:2|max:20',
			'email' => 'required|max:255|email|unique:users',
			'password' => 'required|min:6|matches:confirm_password',
		]);

		echo "success";
	}
}
