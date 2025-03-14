<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('slashes')->group(function () {
	Route::get('feedback/', 					'FeedbackController@get')						        		->name('feedback');
    Route::get('{name}/{id}-{itemName}/', 		'ItemController@getItem')			->whereNumber('id')			->name('item.name');
    Route::get('{name}/', 						'CategoryController@getItem')									->name('category.name');
    Route::get('{name}/{id}-{itemName}/rss/',	'ItemController@getRss')			->whereNumber('id')			->name('comment.rss');
    Route::post('ajax/comment_ajax/', 			'ItemController@getAjax')			->whereNumber('id')			->name('comment.ajax');
    Route::get('ajax/comment/{id}', 			'CommentController@get')			->whereNumber('id')			->name('comment.id.ajax');
});
    Route::post('feedback/', 					'FeedbackController@send')				        				->name('feedback.send');
    Route::post('ajax/comment/store', 			'CommentController@store')		                                ->name('comment.store');

require __DIR__.'/auth.php';
