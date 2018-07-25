<?php

//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Featurte
Route::group([], function () {
	Route::get('/', 							['as' => 'index', 			'uses' => 'CategoryController@index']);
	Route::get('/{id}', 						['as' => 'edit', 			'uses' => 'CategoryController@edit']);
	Route::post('/', 							['as' => 'update', 			'uses' => 'CategoryController@update']);
	Route::get('/create', 						['as' => 'create', 			'uses' => 'CategoryController@create']);
	Route::put('/', 							['as' => 'store', 			'uses' => 'CategoryController@store']);
	Route::delete('/{id}', 						['as' => 'trash', 			'uses' => 'CategoryController@trash']);
	Route::delete('/delete/{id}', 						['as' => 'delete', 			'uses' => 'CategoryController@delete']);

	Route::post('update-status', 				['as' => 'update-status', 	'uses' => 'CategoryController@updateStatus']);
	Route::post('update-delete-status', 				['as' => 'update-delete-status', 	'uses' => 'CategoryController@updateDeletedStatus']);

	Route::group(['as' => 'sub-category.'], function () {
		Route::get('/{id}/category/sub-category', 				['as' => 'index', 			'uses' => 'SubCategoryController@index']);
		Route::get('/{id}/category/sub-category/create', 			['as' => 'create', 			'uses' => 'SubCategoryController@create']);
		Route::put('/category/sub-category', 						['as' => 'store', 			'uses' => 'SubCategoryController@store']);
		Route::get('/{id}/category/sub-category/{subcategory_id}', 		['as' => 'edit', 			'uses' => 'SubCategoryController@edit']);
		Route::post('/category/sub-category', 					['as' => 'update', 			'uses' => 'SubCategoryController@update']);
		Route::delete('/category/sub-category/{subcategory_id}', 		['as' => 'trash', 			'uses' => 'SubCategoryController@trash']);
		Route::delete('/category/sub-category/delete/{subcategory_id}', 		['as' => 'delete', 			'uses' => 'SubCategoryController@delete']);
		
		Route::post('/category/sub-category/update-status', 		['as' => 'update-sub-category-status', 	'uses' => 'SubCategoryController@updateStatus']);
		
		Route::post('/category/sub-category/update-delete-status', 				['as' => 'update-sub-category-delete-status', 	'uses' => 'SubCategoryController@updateDeletedStatus']);

		Route::get('/{category_id}/main-category/{subcategory_id}', 				['as' => 'mainCategory', 	'uses' => 'SubCategoryController@mainCategories']);
		Route::get('/{category_id}/main-category/{subcategory_id}/create', 		['as' => 'create-mainCategory', 	'uses' => 'SubCategoryController@createMainCategory']);
		Route::put('/main-category/store', 				['as' => 'store-mainCategory', 		'uses' => 'SubCategoryController@storeMainCategory']);
		Route::get('/{category_id}/main-category/{subcategory_id}/{maincategory_id}', 		['as' => 'edit-mainCategory', 		'uses' => 'SubCategoryController@editMainCategory']);
		Route::post('/{id}/main-category/update', 		['as' => 'update-mainCategory', 	'uses' => 'SubCategoryController@updateMainCategory']);
		Route::delete('main-category/{id}', 				['as' => 'trash-mainCategory', 		'uses' => 'SubCategoryController@trashMainCategory']);
		Route::delete('main-category/delete/{id}', 				['as' => 'delete-mainCategory', 		'uses' => 'SubCategoryController@deleteMainCategory']);
		Route::post('/main-category/update-delete-status', 				['as' => 'update-main-category-delete-status', 	'uses' => 'SubCategoryController@updateMainDeletedStatus']);
	});


});




			