<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::permanentRedirect('/', '/home');

Route::get('/home', [\App\Http\Controllers\Home\HomeController::class, 'index'])->name('home');
Route::get('/about-us', [\App\Http\Controllers\Home\AboutUsController::class, 'index'])->name('about-us');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';

Route::middleware(['auth', 'verified'])->group(function() {
    Route::resource('books', \App\Http\Controllers\Resource\BookController::class);
    Route::resource('books.feedbacks', \App\Http\Controllers\Resource\FeedbackController::class);

    Route::get('/search-books', [\App\Http\Controllers\User\SearchBookController::class, 'index'])->name('books.search-page');
    Route::get('/search-books/query', [\App\Http\Controllers\User\SearchBookController::class, 'search'])->name('books.search');
});

Route::group(['middleware' => ['role_or_permission:superadmin|account.manage']], function () {
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
});


//Only for testing purposes
Route::prefix('test')->group( function() {
    Route::get('auto-login', [\App\Http\Controllers\Auth\LoginController::class, 'autoLogin'])->name('auto-login');
    Route::resource('books', \App\Http\Controllers\Resource\BookController::class);
    Route::get('/books-delete-confirm/{book}', [\App\Http\Controllers\Resource\BookController::class, 'confirm'])->name('books.confirm');
    Route::resource('permissions', \App\Http\Controllers\PermissionController::class);
    Route::get('/search-books', [\App\Http\Controllers\User\SearchBookController::class, 'index'])->name('books.search-page');
});
