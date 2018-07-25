<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'PromotionController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'PromotionController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'PromotionController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'PromotionController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'PromotionController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'PromotionController@trash']);
	Route::delete('/delete/{id}', 						['as' => 'delete', 			'uses' => 'PromotionController@delete']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'PromotionController@updateStatus']);
	Route::post('update-delete-status', 				['as' => 'update-delete-status', 	'uses' => 'PromotionController@updateDeletedStatus']);
});




			