<?php 


		//:::::::::::::>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Page Contents
		Route::group(['as' => 'content.', 'prefix' => 'content'], function() {
			Route::get('list/{page}', 	['as' => 'list', 	'uses' => 'ContentsController@listData']);
			Route::get('/{slug}', 		['as' => 'edit', 	'uses' => 'ContentsController@showEditForm']);
			Route::post('/', 			['as' => 'update', 	'uses' => 'ContentsController@update']);
		});
		
		