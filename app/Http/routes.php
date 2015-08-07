<?php

Route::get('/', 'AreaController@index');
Route::resource('area', 'AreaController');
Route::resource('order', 'OrderController');
Route::resource('category', 'CategoryController');
Route::get('help', 'UtilsController@help');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'admin' => 'AdminController',
	'backstage' => 'BackstageController',
	'config' => 'ConfigController'
]);