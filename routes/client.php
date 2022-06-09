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
    Route::get('/dashboard', [\App\Http\Controllers\User\Client\ClientHomeController::class, 'index'])->name('dashboard');

    Route::name('users.')->group(function() {
        Route::get('/borrow-book/users/history', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'index'])->name('books.borrows.index');
        Route::get('/borrow-book/{book}/create', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'create'])->name('books.borrows.create');
        Route::post('/borrow-book/{book}', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'store'])->name('books.borrows.store');
        Route::get('/borrow-book/{book}', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'show'])->name('books.borrows.show');
        Route::get('/borrow-book/{book}/edit', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'edit'])->name('books.borrows.edit');
        Route::put('/borrow-book/{book}', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'update'])->name('books.borrows.update');
        Route::delete('/borrow-book/{book}', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'destroy'])->name('books.borrows.destroy');
        Route::put('/borrow-book/{book}/return', [\App\Http\Controllers\User\Client\ClientBorrowController::class, 'returnBook'])->name('books.borrows.return');
    });
});