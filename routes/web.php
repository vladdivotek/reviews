<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\ReviewController::class, 'index'])->name('review.index');
Route::post('review/store', [\App\Http\Controllers\ReviewController::class, 'store'])->name('review.store');
