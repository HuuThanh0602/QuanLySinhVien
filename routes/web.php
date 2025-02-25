<?php

use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\admin\SubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware(['auth',AdminMiddleware::class])
    ->group(function(){  
        Route::name('admin.department.')
            ->prefix('admin/department')
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
            ->prefix('admin/student')
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
            ->prefix('admin/subject')
            ->controller(SubjectController::class)
            ->group(function(){
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store' ,'store')->name('store');
                Route::get('/{id}/edit','edit')->name('edit');
                Route::put('/{id}/update', 'update')->name('update');
                Route::delete('/{id}/destroy','destroy')->name('destroy');
        });
    });