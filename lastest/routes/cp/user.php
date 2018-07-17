<?php 

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> User
Route::group(['as' => 'user.',  'prefix' => 'user'], function () {
	Route::get('/', 				['as' => 'index', 			'uses' => 'UsersController@index']);
	Route::get('/{id}', 			['as' => 'edit', 			'uses' => 'UsersController@showEditForm']);
	Route::post('/', 				['as' => 'update', 			'uses' => 'UsersController@update']);
	Route::get('/create', 			['as' => 'create', 			'uses' => 'UsersController@showCreateForm']);
	Route::put('/', 				['as' => 'store', 			'uses' => 'UsersController@store']);
	Route::delete('/{id}', 			['as' => 'trash', 			'uses' => 'UsersController@destroy']);
	Route::post('/update-status', 	['as' => 'update-status', 	'uses' => 'UsersController@updateStatus']);
	Route::post('/update-valid-ip', ['as' => 'update-valid-ip', 'uses' => 'UsersController@updateValidateIP']);
	Route::post('/update-password', ['as' => 'update-password', 'uses' => 'UsersController@updatePassword']);
	Route::get('/{id}/logs', 		['as' => 'logs', 			'uses' => 'UsersController@logs']);
});
