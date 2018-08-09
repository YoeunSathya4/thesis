<?php
Route::get('{locale}/home', 				[ 'as' => 'home',			'uses' => 'HomeController@index']);
Route::get('{locale}/about-us', 			[ 'as' => 'about-us',			'uses' => 'AboutUsController@index']);
Route::get('{locale}/product', 				[ 'as' => 'product',			'uses' => 'ProductController@index']);
Route::get('{locale}/search-product', 				[ 'as' => 'search-product',			'uses' => 'ProductController@searchProduct']);
Route::get('{locale}/product-detail/{slug}', 				[ 'as' => 'product-detail',			'uses' => 'ProductController@detail']);

Route::get('{locale}/promotion', 			[ 'as' => 'promotion',			'uses' => 'PromotionController@index']);
Route::get('{locale}/news', 				[ 'as' => 'news',			'uses' => 'NewsController@index']);
Route::get('{locale}/news-detail/{slug}', 				[ 'as' => 'news-detail',			'uses' => 'NewsController@detail']);
Route::get('{locale}/contact-us', 			[ 'as' => 'contact-us',			'uses' => 'ContactUsController@index']);
Route::put('{locale}/submit-contact', 	[ 'as' => 'submit-contact',			'uses' => 'ContactUsController@submitContact']);

//======================================================> add To Favorite
// Route::post('{locale}/add-to-favorite', 				[ 'as' => 'add-to-favorite',			'uses' => 'FrontendController@addToFavorite']);
// Route::get('{locale}/remove-from-favorite', 				[ 'as' => 'remove-from-favorite',			'uses' => 'FrontendController@removeFromFavorite']);
//======================================================> add To Favorite
Route::get('{locale}/add-to-favorite/{id}', 				[ 'as' => 'add-to-favorite',			'uses' => 'FrontendController@addToFavorite']);
Route::get('{locale}/remove-from-favorite/{id}', 				[ 'as' => 'remove-from-favorite',			'uses' => 'FrontendController@removeFromFavorite']);

//========================================================> Add To Cart
Route::get('{locale}/add-to-cart/{id}', 			[ 'as' => 'add-to-cart',			'uses' => 'ProductController@AddToCart']);
Route::get('{locale}/shopping-cart', 			[ 'as' => 'shopping-cart',			'uses' => 'ProductController@ShoppingCart']);
Route::get('{locale}/checkout', 			[ 'as' => 'checkout',			'uses' => 'ProductController@Checkout']);
Route::get('{locale}/buy/{id}', 			[ 'as' => 'buy',			'uses' => 'ProductController@Buy']);
Route::post('{locale}/checkouts', 				[ 'as' => 'checkouts',			'uses' => 'ProductController@postCheckout']);
Route::get('{locale}/reduce/{id}', 			[ 'as' => 'reduce',			'uses' => 'ProductController@getReduceByOne']);
Route::get('{locale}/plus/{id}', 			[ 'as' => 'plus',			'uses' => 'ProductController@getPlusByOne']);

Route::get('{locale}/remove/{id}', 			[ 'as' => 'remove',			'uses' => 'ProductController@RemoveItem']);
Route::get('{locale}/thanks', 			[ 'as' => 'thanks',			'uses' => 'ProductController@thanks']);
//============================================ Login SignUp Process
Route::get('{locale}/login', 					[ 'as' => 'login',			'uses' => 'LoginController@showFormLogin']);
Route::post('{locale}/submit-login', 			['as' => 'submit-login', 				'uses' => 'LoginController@login']);
Route::get('{locale}/logout', 					[ 'as' => 'logout',			'uses' => 'LoginController@logout']);
Route::get('{locale}/profile', 					[ 'as' => 'profile',			'uses' => 'ProfileController@index']);
Route::post('/update-profile', 					['as' => 'update-profile', 			'uses' => 'ProfileController@update']);
Route::get('{locale}/sign-up', 					[ 'as' => 'sign-up',			'uses' => 'SignUpController@showRegisterForm']);
Route::post('{locale}/register', 				[ 'as' => 'register',					'uses' => 'SignUpController@register']);
Route::get('{locale}/forgot-password', 			['as' => 'forgot-password', 			'uses' => 'ForgotPasswordController@showLinkRequestForm']);//display forgot password form
//=================================== Order 
Route::get('{locale}/favorite-product', 					[ 'as' => 'favorite-product',			'uses' => 'ProfileController@favoriteProduct']);

Route::get('{locale}/panding-order', 					[ 'as' => 'panding-order',			'uses' => 'ProfileController@pandingOrder']);
Route::get('{locale}/order-history', 					[ 'as' => 'order-history',			'uses' => 'ProfileController@orderHistory']);
Route::get('{locale}/order-history-detail/{id}', 					[ 'as' => 'order-history-detail',			'uses' => 'ProfileController@orderHistoryDetail']);

Route::post('{locale}/forgot-password', 		['as' => 'make-forgot-password-code', 	'uses' => 'ForgotPasswordController@sendResetCode']); 
Route::get('{locale}/reset-password/{token}', 	['as' => 'reset-password', 				'uses' => 'ResetPasswordController@showResetForm']); //After verify the code, a form of reseting new password is here
Route::post('{locale}/password/reset', 			['as' => 'reset', 						'uses' => 'ResetPasswordController@reset']); // Get new password from the form and change
Route::get('{locale}/verify-forgot-password-code', 				[ 'as' => 'verify-forgot-password-code',			'uses' => 'ForgotPasswordController@verifyCodeForm']);
Route::post('{locale}/submit-forgot-password-code', 			[ 'as' => 'submit-forgot-password-code',					'uses' => 'ForgotPasswordController@submitCodeForgotPassword']);

Route::get('{locale}/verify-code', 				[ 'as' => 'verify-code',			'uses' => 'SignUpController@verifyCodeForm']);
Route::post('{locale}/submit-code', 			[ 'as' => 'submit-code',					'uses' => 'SignUpController@submitCode']);

Route::get('{locale}/new-password', 				[ 'as' => 'new-password',			'uses' => 'ProfileController@newPassword']);
Route::post('{locale}/submit-new-password', 			[ 'as' => 'submit-new-password',					'uses' => 'ProfileController@submitNewPassword']);

Route::post('change-password', 			[ 'as' => 'change-password',					'uses' => 'ProfileController@changePassword']);