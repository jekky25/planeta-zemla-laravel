<?php

Route::get('/', 'HomeController@index')->name('home');
Route::middleware('slashes')->group(function () {
	Route::post('feedback/', 					'FeedbackController@sendFeedBack')								->name('sendFeedback');
	Route::get('feedback/', 					'FeedbackController@getFeedBack')								->name('feedback');

	Route::get('{name}/{id}-{itemName}/', 		'ItemController@getItem')			->whereNumber('id')			->name('item_name');
	Route::get('{name}/', 						'CategoryController@getItem')									->name('category_name');
	Route::get('{name}/{id}-{itemName}/rss/',	'ItemController@getRss')			->whereNumber('id')			->name('comment_rss');
	Route::post('ajax/comment_ajax/', 			'ItemController@getAjax')			->whereNumber('id')			->name('comment_ajax');
});