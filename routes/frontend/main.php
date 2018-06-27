<?php
Route::get('{locale}/home', 				[ 'as' => 'home',			'uses' => 'HomeController@index']);
Route::get('{locale}/about-us', 			[ 'as' => 'about-us',			'uses' => 'AboutUsController@index']);
Route::get('{locale}/product', 				[ 'as' => 'product',			'uses' => 'ProductController@index']);
Route::get('{locale}/promotion', 			[ 'as' => 'promotion',			'uses' => 'PromotionController@index']);
Route::get('{locale}/news', 				[ 'as' => 'news',			'uses' => 'NewsController@index']);
Route::get('{locale}/news-detail/{slug}', 				[ 'as' => 'news-detail',			'uses' => 'NewsController@detail']);
Route::get('{locale}/contact-us', 			[ 'as' => 'contact-us',			'uses' => 'ContactUsController@index']);
Route::put('{locale}/submit-contact', 	[ 'as' => 'submit-contact',			'uses' => 'ContactUsController@submitContact']);

//============================================ Login SignUp Process
Route::get('{locale}/login', 				[ 'as' => 'login',			'uses' => 'LoginController@showFormLogin']);
Route::post('{locale}/submit-login', 		['as' => 'submit-login', 				'uses' => 'LoginController@login']);
Route::get('{locale}/logout', 				[ 'as' => 'logout',			'uses' => 'LoginController@logout']);
Route::get('{locale}/profile', 				[ 'as' => 'profile',			'uses' => 'ProfileController@index']);
Route::post('/update-profile', 				['as' => 'update-profile', 			'uses' => 'ProfileController@update']);
Route::get('{locale}/sign-up', 				[ 'as' => 'sign-up',			'uses' => 'SignUpController@showRegisterForm']);
Route::post('{locale}/register', 			[ 'as' => 'register',					'uses' => 'SignUpController@register']);
Route::get('{locale}/forgot-password', 		['as' => 'forgot-password', 			'uses' => 'ForgotPasswordController@showLinkRequestForm']);//display forgot password form
Route::post('{locale}/forgot-password', 	['as' => 'make-forgot-password-code', 	'uses' => 'ForgotPasswordController@sendResetLinkEmail']); 
Route::get('{locale}/reset-password/{token}', 	['as' => 'reset-password', 				'uses' => 'ResetPasswordController@showResetForm']); //After verify the code, a form of reseting new password is here
Route::post('{locale}/password/reset', 			['as' => 'reset', 						'uses' => 'ResetPasswordController@reset']); // Get new password from the form and change
Route::get('{locale}/verify-code', 				[ 'as' => 'verify-code',			'uses' => 'SignUpController@verifyCodeForm']);
Route::post('{locale}/submit-code', 			[ 'as' => 'submit-code',					'uses' => 'SignUpController@submitCode']);