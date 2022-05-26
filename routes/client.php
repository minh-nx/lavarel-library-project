<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Routes in this file are for admin only.
|
*/

Route::middleware(['auth', 'verified', 'client'])->group(function() {
    Route::get('/home', [\App\Http\Controllers\User\Client\ClientHomeController::class, 'index'])->name('home');

    Route::get('/borrow-book', [\App\Http\Controllers\User\Client\BorrowBookController::class, 'index'])->name('books.borrows.index');
    Route::get('/borrow-book/{book}/create', [\App\Http\Controllers\User\Client\BorrowBookController::class, 'create'])->name('books.borrows.create');
    Route::post('/borrow-book/{book}', [\App\Http\Controllers\User\Client\BorrowBookController::class, 'store'])->name('books.borrows.store');
    Route::get('/borrow-book/{book}', [\App\Http\Controllers\User\Client\BorrowBookController::class, 'show'])->name('books.borrows.show');
    Route::delete('/borrow-book/{book}', [\App\Http\Controllers\User\Client\BorrowBookController::class, 'destroy'])->name('books.borrows.destroy');

    Route::resource('books.feedbacks', \App\Http\Controllers\Resource\FeedbackController::class);
});