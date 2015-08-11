<?php

Route::get('/', 'AreaController@index');
Route::get('help', 'UtilsController@help');
Route::get('area/{id}/print', 'AreaController@printer');

Route::resource('area', 'AreaController');
Route::resource('order', 'OrderController');
Route::resource('category', 'CategoryController');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'admin' => 'AdminController',
	'backstage' => 'BackstageController',
	'config' => 'ConfigController',
	'users' => 'UsersController'
]);
