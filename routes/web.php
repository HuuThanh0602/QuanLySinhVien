<?php

use App\Http\Controllers\admin\DepartmentController;
use Illuminate\Support\Facades\Route;


Route::name('admin.department.')
    ->prefix('department')
    ->controller(DepartmentController::class)
    ->group(function () {
    Route::get('/',  'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}/update', 'update')->name('update');
    Route::delete('/{id}/destroy', 'destroy')->name('destroy');
});