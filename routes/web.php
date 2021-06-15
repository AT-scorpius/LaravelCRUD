<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('CRUD',[ProductController::class, 'index'])->name('crud.index');
Route::get('search',[ProductController::class, 'search'])->name('crud.search');
Route::post('CRUD', [ProductController::class, 'store'])->name('crud.store');
Route::get('edit/{id}', [ProductController::class, 'edit'])->name('crud.edit');
Route::put('CRUD/{id}', [ProductController::class, 'update'])->name('crud.update');
Route::delete('CRUD/{id}', [ProductController::class, 'destroy'])->name('crud.destroy');

Route::get('link/{id}/branch/{branchId}', function ($id, $branchId) {
    return "Link ${id} With Branch ${branchId}";
})->name('link.id.branch');
