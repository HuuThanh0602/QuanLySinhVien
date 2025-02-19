<?php

use App\Http\Controllers\admin\DepartmentsController;
use App\Http\Controllers\admin\QLSVController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DepartmentsController::class, 'index'])->name('admin.department.index');
Route::get('/department/create', [DepartmentsController::class, 'create'])->name('admin.department.create');
Route::post('department/store',[DepartmentsController::class, 'store'])->name('admin.department.store');
Route::get('department/{id}/edit',[DepartmentsController::class, 'edit'])->name('admin.department.edit');
Route::put('department/{id}/update',[DepartmentsController::class, 'update'])->name('admin.department.update');
Route::delete('department/{id}/destroy',[DepartmentsController::class, 'destroy'])->name('admin.department.destroy');