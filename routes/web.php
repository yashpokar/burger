<?php

use Burger\Http\Route;

Route::get('/', 'HomeController@index');

// AuthController
Route::get('/register', 'AuthController@registerForm');
Route::post('/register', 'AuthController@register');
