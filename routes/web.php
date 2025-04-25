<?php

use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\Admin\AdminResultController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Admin\RolePermissionController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\Student\RegisterController;
use App\Http\Controllers\Student\ResultController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\LangMiddleware;
use App\Http\Middleware\StudentMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;

Broadcast::routes(['middleware' => ['auth']]);



Route::middleware([LangMiddleware::class])->group(function () {
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login_');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('locale', [LangController::class, 'changLang'])->name('locale.change');
});
Route::middleware(['auth',  LangMiddleware::class])
    ->group(function () {
        Route::post('/chat/message', [ChatController::class, 'messageReceived'])->name('chat.message');
        Route::post('/chat/message/{id}', [ChatController::class, 'sendMessagePrivate'])->name('chat.sendMessagePrivate');


        
Route::get('chat', [ChatController::class, 'index'])->name('chat');
Route::get('/chat/getMessage/{user}', [ChatController::class, 'getMessages']);
Route::post('/chat/sendMessage', [ChatController::class, 'sendMessage']);

    });



Route::middleware(['auth', AdminMiddleware::class, LangMiddleware::class])
    ->group(function () {
        Route::get('admin', [HomeController::class, 'indexAdmin'])->name('admin.home');

        Route::get('/admin/chat', [ChatController::class, 'indexAdmin'])->name('admin.chat');
    });

Route::middleware(['auth', 'permission:manage departments', LangMiddleware::class])
    ->group(
        function () {
            Route::name('admin.department.')
                ->prefix('admin/department')
                ->controller(DepartmentController::class)
                ->group(function () {
                    Route::get('/',  'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('{id}/edit', 'edit')->name('edit');
                    Route::put('{id}/update', 'update')->name('update');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                });
        }
    );

Route::middleware(['auth', 'permission:manage users', LangMiddleware::class])
    ->group(
        function () {
            Route::name('admin.user.')
                ->prefix('admin/user')
                ->controller(UserController::class)
                ->group(function () {
                    Route::get('/',  'index')->name('index');
                    Route::post('store', 'store')->name('store');
                    Route::post('update', 'update')->name('update');
                });
            Route::name('admin.role.')
                ->prefix('admin/role')
                ->controller(RolePermissionController::class)
                ->group(function () {
                    Route::get('/',  'index')->name('index');
                    Route::post('storeRole', 'storeRole')->name('storeRole');
                    Route::post('updatePermission', 'updatePermission')->name('updatePermission');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                });
        }
    );

Route::middleware(['auth', 'permission:manage students', LangMiddleware::class])
    ->group(
        function () {
            Route::name('admin.student.')
                ->prefix('admin/student')
                ->controller(StudentController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('{id}/edit', 'edit')->name('edit');
                    Route::put('{id}/update', 'update')->name('update');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                    Route::get('delete/yearOld', 'destroyYearOld')->name('destroyYearOld');

                    Route::get('{id}/subjectNotStudied', 'subjectNotStudied')->name('subjectNotStudied');
                });
        }
    );

Route::middleware(['auth', 'permission:manage subjects', LangMiddleware::class])
    ->group(
        function () {
            Route::name('admin.subject.')
                ->prefix('admin/subject')
                ->controller(SubjectController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('create', 'create')->name('create');
                    Route::post('store', 'store')->name('store');
                    Route::get('{id}/edit', 'edit')->name('edit');
                    Route::put('{id}/update', 'update')->name('update');
                    Route::delete('{id}/destroy', 'destroy')->name('destroy');
                });
        }
    );

Route::middleware(['auth', 'permission:manage results', LangMiddleware::class])
    ->group(
        function () {
            Route::name('admin.result.')
                ->prefix('admin/result')
                ->controller(AdminResultController::class)
                ->group(function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('{id}/show', 'show')->name('show');
                    Route::post('store', 'store')->name('store');
                    Route::post('importExcel', 'importExcel')->name('importExcel');
                    //yeucau2
                    Route::get('updateScore', 'updateScore')->name('updateScore');
                });
        }
    );
    Route::get('/student/chat', [ChatController::class, 'indexStudent'])->name('student.chat');

Route::middleware(['auth', StudentMiddleware::class, LangMiddleware::class])
    ->group(function () {
        Route::name('student.profile.')
            ->prefix('student/profile')
            ->controller(ProfileController::class)
            ->group(function () {
                Route::get('/',  'index')->name('index');
                Route::put('{id}/update', 'update')->name('upload');
            });

        Route::name('student.register.')
            ->prefix('student/register')
            ->controller(RegisterController::class)
            ->group(function () {
                Route::get('/',  'index')->name('index');
                Route::get('register', 'register')->name('store');
            });

        Route::name('student.result.')
            ->prefix('student/result')
            ->controller(ResultController::class)
            ->group(function () {
                Route::get('/',  'index')->name('index');
            });
    });


