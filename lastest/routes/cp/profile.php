<?php 

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> User Profile
Route::group(['as' => 'profile.', 'prefix' => 'profile'], function() {
	Route::get('/', 		['as' => 'edit', 	'uses' => 'ProfileController@edit']);
	Route::post('update', 	['as' => 'update', 	'uses' => 'ProfileController@update']);
	Route::get('password', 	['as' => 'edit-password', 	'uses' => 'ProfileController@editPassword']);
	Route::post('password/update', 	['as' => 'update-password', 	'uses' => 'ProfileController@changePassword']);
	Route::get('logs', 				['as' => 'logs', 	'uses' => 'ProfileController@logs']);
});