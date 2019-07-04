<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Tutorial</title>
</head>
<body>
	<h3>Welcome to Burger, Mr. {{ $user->first_name }}</h3>

	<ul>
		@foreach ($users as $user)
			<li>{{ $user->first_name }} {{ $user->last_name }}</li>
		@endforeach
	</ul>

	<p>Total {{ $usersCount }} users found!</p>
</body>
</html>
