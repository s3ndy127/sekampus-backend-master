<?php
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

Route::group(['prefix' => 'pages', 'namespace' => 'Admin'], function () {
	Route::get('ketentuan', 'PagesController@ketentuan');
});

Route::group([
	'prefix' => config('backpack.base.route_prefix', 'admin'),
	'middleware' => ['role:Administrator', 'admin'],
	'namespace' => 'Admin',
], function () {

	CRUD::resource('slider', 'SliderCrudController');
	CRUD::resource('items', 'ItemsCrudController');
	CRUD::resource('merchant', 'MerchantCrudController');
	CRUD::resource('food', 'FoodCrudController');
	CRUD::resource('campus', 'CampusCrudController');
	CRUD::resource('freemeal', 'FreemealCrudController');
	CRUD::resource('catering', 'CateringCrudController');
	CRUD::resource('sekeranjang', 'SekeranjangCrudController');
	CRUD::resource('sekeranjangorder', 'SekeranjangOrderCrudController');
	CRUD::resource('cateringorder', 'CateringorderCrudController');
	CRUD::resource('setting', 'SettingCrudController');
	CRUD::resource('komunitas', 'KomunitasCrudController');
	CRUD::resource('category/komunitas', 'CategoryKomunitasCrudController');
	CRUD::resource('event/komunitas', 'EventsCrudController');
	CRUD::resource('menu', 'MenuCrudController');
	Route::get('catering/{delete}/delete', 'MenuCrudController@destroy')->name('crud.menu.delete');
	CRUD::resource('review', 'ReviewCrudController');

	Route::get('freemeal/{id}/accept', 'FreemealCrudController@accept');
	Route::get('freemeal/{id}/finish', 'FreemealCrudController@finish');

	Route::get('cateringorder/{id}/accept', 'CateringorderCrudController@accept');
	Route::get('cateringorder/{id}/finish', 'CateringorderCrudController@finish');

	Route::get('catering/{id}/menu', 'MenuCrudController@addMenu');

	Route::get('catering/{id}/editmenu', ['as' => 'catering::editmenu', 'uses' => 'MenuCrudController@editMenu']);

	Route::get('catering/{id}/showmenu', 'MenuCrudController@showMenu');

	Route::get('catering/{id}/details', 'MenuCrudController@showMenu');

	Route::get('test', 'SettingCrudController@test');

});

Route::get('optimize', function () {
	$process = new Process('cd .. && sh deploy.sh');
	$process->run();

	if (!$process->isSuccessful()) {
		throw new ProcessFailedException($process);
	}

	echo $process->getOutput();
});

Route::get('/', '\Backpack\Base\app\Http\Controllers\Auth\LoginController@showLoginForm');
