<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'ProductController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'ProductController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'ProductController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'ProductController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'ProductController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'ProductController@trash']);
	Route::delete('/delete/{id}', 						['as' => 'delete', 			'uses' => 'ProductController@delete']);
	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'ProductController@updateStatus']);
	Route::post('update-featured', 				['as' => 'update-featured', 	'uses' => 'ProductController@updateFeatured']);
	Route::post('update-delete-status', 				['as' => 'update-delete-status', 	'uses' => 'ProductController@updateDeletedStatus']);
	//Route::delete('delete', 				['as' => 'delete', 	'uses' => 'ProductController@deleted']);
	Route::get('/sub-category', 						['as' => 'get-sub-category', 			'uses' => 'ProductController@getSubCategory']);

	Route::get('/main-category', 						['as' => 'get-main-category', 			'uses' => 'ProductController@getMainCategory']);
});




			