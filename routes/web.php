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

Route::permanentRedirect('/', '/guest');

Route::get('/guest', [\App\Http\Controllers\Home\GuestHomeController::class, 'index'])->middleware('guest')->name('guest.home');
Route::get('/about-us', [\App\Http\Controllers\Home\AboutUsController::class, 'index'])->name('about-us');

require __DIR__.'/auth.php';
require __DIR__.'/admin.php';
require __DIR__.'/client.php';

Route::middleware(['auth', 'verified'])->group(function() {
    Route::resource('books', \App\Http\Controllers\Resource\BookController::class);

    Route::get('/search-books', [\App\Http\Controllers\User\SearchBookController::class, 'index'])->name('books.search-page');
    Route::get('/search-books/query', [\App\Http\Controllers\User\SearchBookController::class, 'search'])->name('books.search');
});
