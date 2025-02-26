<?php

use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\RegisterController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LangMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login_');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/locale', [LangController::class, 'changLang'])->name('locale.change');


Route::middleware(['auth',AdminMiddleware::class,LangMiddleware::class])
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
    
Route::middleware(['auth',StudentMiddleware::class,LangMiddleware::class])
->group(function(){  
    Route::name('student.profile.')
        ->prefix('student/profile')
        ->controller(ProfileController::class)
        ->group(function () {
        Route::get('/',  'index')->name('index');
        Route::put('/{id}/update', 'update')->name('update');
    });
    Route::name('student.register.')
        ->prefix('student/register')
        ->controller(RegisterController::class)
        ->group(function () {
        Route::get('/',  'index')->name('index');
        Route::get('/register', 'register')->name('store');
    });
});