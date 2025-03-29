<?php

use App\Http\Controllers\CreditCardController;
use App\Http\Controllers\Admin\CreditCardController as AdminCardController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
Route::get('/', [CreditCardController::class, 'start'])->name('cards.start');
Route::get('/cards', [CreditCardController::class, 'index'])->name('cards.index');

// Admin (using prefix/grouping)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('cards', [AdminCardController::class, 'index'])->name('cards.index');
    Route::get('cards/{id}/edit', [AdminCardController::class, 'edit'])->name('cards.edit');
    Route::put('cards/{id}', [AdminCardController::class, 'update'])->name('cards.update');
    Route::delete('cards/{cardId}/manual-edit/{field}', [AdminCardController::class, 'removeEdit'])->name('cards.removeEdit');
});
