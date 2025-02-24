<?php

use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\LocaleController;
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
Route::name('admin.student.')
    ->prefix('student')
    ->controller(StudentController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store' ,'store')->name('store');
        Route::get('/{id}/edit','edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy','destroy')->name('destroy');
});
Route::name('admin.subject.')
    ->prefix('subject')
    ->controller(SubjectController::class)
    ->group(function(){
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store' ,'store')->name('store');
        Route::get('/{id}/edit','edit')->name('edit');
        Route::put('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy','destroy')->name('destroy');
    });