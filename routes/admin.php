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

Route::middleware(['auth', 'verified', 'admin'])->prefix('/admin')->name('admin.')->group(function() {
    Route::get('/dashboard', [\App\Http\Controllers\User\Admin\AdminHomeController::class, 'index'])->name('dashboard');

    Route::prefix('/borrow-book')->group(function() {
        Route::get('/history', [\App\Http\Controllers\User\Admin\AdminBorrowController::class, 'index'])->name('books.borrows.index');
        Route::get('/history/{book}', [\App\Http\Controllers\User\Admin\AdminBorrowController::class, 'show'])->name('books.borrows.show');
    });
});
