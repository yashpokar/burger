<?php

namespace App\Controllers;

use Burger\Database\DB;
use App\Models\User;

class HomeController
{
	public function index()
	{
		/////////////////
		// InsertQuery //
		/////////////////

		if (! DB::table('users')->find(5)) {
			DB::table('users')->insert([
				'id' => 5,
				'first_name' => 'Meet',
				'last_name' => 'Pokar',
				'email' => 'hello@meetpokar.com',
				'password' => 'MeetPatel@890',
			]);
		}

		/////////////////
		// UpdateQuery //
		/////////////////
		// DB::table('users')
		// ->where('id', 1)
		// ->update([
		// 	'last_name' => 'Pokar',
		// ]);

		/////////////////
		// SearchQuery //
		/////////////////
		$users = DB::table('users')
			// ->where('last_name', 'Bathani')
			->all();

		///////////////
		// Row count //
		///////////////
		$usersCount = DB::table('users')
		->where('last_name', 'Bathani')
		->count();

		if ($users == User::all() && User::where('last_name', 'Bathani')->count() == $usersCount) {
			echo "Models are doing well";
		}

		//////////////////////////////
		// Search First Only Helper //
		//////////////////////////////
		$user = DB::table('users')
			// ->where('first_name', 'Yash')
			->first();

		/////////////////
		// DeleteQuery //
		/////////////////

		// DB::table('users')
		// 	->where('last_name', 'Bathani')
		// 	->delete();

		return view('home', compact('users', 'user', 'usersCount'));
	}
}
