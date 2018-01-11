<?php

Route::group([
	'prefix' => 'slider',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Slider\SliderController@index');

});

Route::group([
	'prefix' => 'history',
	'namespace' => 'Api',
	'middleware' => 'jwt.auth',

], function () {

	Route::get('/', 'History\HistoryController@index');
	Route::get('detail/{invoice}/{type}', 'History\HistoryController@detail');

});

Route::group([
	'prefix' => 'frontend',
	'namespace' => 'Api',

], function () {

	Route::get('/merchant', 'Merchant\MerchantController@get');

});

Route::group([
	'prefix' => 'payment',
	'namespace' => 'Api',
	'middleware' => 'jwt.auth',

], function () {

	Route::post('create', 'Payment\PaymentController@create');

	Route::post('image', 'Payment\PaymentController@getImage');

});

Route::group([
	'prefix' => 'merchant',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Merchant\MerchantController@index');

});

Route::group([
	'prefix' => 'food',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Food\FoodController@index');

});

Route::group([
	'prefix' => 'setting',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Setting\SettingController@index');

});

Route::group([
	'prefix' => 'sekeranjang',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Sekeranjang\SekeranjangController@index');

	Route::post('order', 'Sekeranjang\SekeranjangController@order')
		->middleware('jwt.auth');

});

Route::group([
	'prefix' => 'campus',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Campus\CampusController@index');

});

Route::group([
	'prefix' => 'sekost',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'SeKost\SeKostController@index');

	Route::get('nearby', 'SeKost\SeKostController@nearby');

});

Route::group([
	'prefix' => 'komunitas',
	'namespace' => 'Api',

], function () {

	Route::get('/', 'Komunitas\KomunitasController@index');

	Route::post('home', 'Komunitas\KomunitasController@homeKomunitas');

	Route::post('comments/send', 'Komunitas\KomunitasController@sendComment')->middleware('jwt.auth');

});

Route::group([
	'prefix' => 'freemeal',
	'namespace' => 'Api',
	'middleware' => 'jwt.auth',

], function () {

	Route::post('order', 'FreemealOrder\FreemealOrderController@store');

	Route::get('finish/{id}', 'FreemealOrder\FreemealOrderController@finish');

});

Route::group([
	'prefix' => 'catering',
	'namespace' => 'Api',

], function () {

	Route::get('detail/{id}', 'Catering\CateringController@detail');

	Route::get('menu/{id}', 'Catering\CateringController@menu');

	Route::post('order', 'Catering\CateringController@store')
		->middleware('jwt.auth');

});

Route::group([
	'prefix' => 'review',
	'namespace' => 'Api',
	'middleware' => 'jwt.auth',

], function () {

	Route::post('store', 'Review\ReviewController@store');

});

Route::group([

	'prefix' => 'account',
	'namespace' => 'Api',

], function () {

	Route::post('auth', [
		'as' => 'auth',
		'uses' => 'Account\AccountController@login',
	]);

	Route::post('register', [
		'as' => 'register',
		'uses' => 'Account\AccountController@register',
	]);

	Route::post('update', [
		'as' => 'update',
		'middleware' => 'auth:api',
		'uses' => 'Account\AccountController@update',
	]);

	Route::post('update/fcm', [
		'as' => 'updatefcm',
		'middleware' => 'auth:api',
		'uses' => 'Account\AccountController@updateFcm',
	]);

	Route::post('token', [
		'as' => 'token',
		'uses' => 'Account\AccountController@token',
	]);

	Route::post('reset', [
		'as' => 'reset',
		'uses' => 'Account\AccountController@resetPasswordByToken',
	]);

});

Route::group([
	'prefix' => 'frontend',
	'namespace' => 'Api',

], function () {

	Route::get('notification', 'History\HistoryController@notification')
		->name('api::notification');

});