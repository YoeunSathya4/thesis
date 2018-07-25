<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'NewsController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'NewsController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'NewsController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'NewsController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'NewsController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'NewsController@trash']);
	Route::delete('/delete/{id}', 						['as' => 'delete', 			'uses' => 'NewsController@delete']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'NewsController@updateStatus']);
	Route::post('update-delete-status', 				['as' => 'update-delete-status', 	'uses' => 'NewsController@updateDeletedStatus']);
	
});




			