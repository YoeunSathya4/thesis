<?php
//:::::::::::::::::::::::::::::::>>> Main
Route::group([], function () {
	Route::get('/', 		['as' => 'index', 			'uses' => 'MainController@index']);
});	

