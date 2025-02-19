<?php

use App\Http\Controllers\admin\DepartmentsController;
use App\Http\Controllers\admin\QLSVController;
use Illuminate\Support\Facades\Route;


Route::name('admin.department.')->group(function () {
    Route::get('/', [DepartmentsController::class, 'index'])->name('index');
    Route::get('/create', [DepartmentsController::class, 'create'])->name('create');
    Route::post('/store',[DepartmentsController::class, 'store'])->name('store');
    Route::get('/{id}/edit',[DepartmentsController::class, 'edit'])->name('edit');
    Route::put('/{id}/update',[DepartmentsController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy',[DepartmentsController::class, 'destroy'])->name('destroy');

});