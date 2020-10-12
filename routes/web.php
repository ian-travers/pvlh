<?php

Route::get('/', function () {
    return view('welcome');
})->name('root');

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');

// User Profile
Route::group([
    'prefix' => 'profile',
    'as' => 'profile',
    'middleware' => 'auth',
],
    function () {
        Route::get('/', [App\Http\Controllers\User\ProfileController::class, 'show']);
        Route::post('/', [App\Http\Controllers\User\ProfileController::class, 'update'])
            ->middleware('verified')
            ->name('.update');
        Route::post('/email', [App\Http\Controllers\User\ProfileController::class, 'changeEmail'])
            ->name('.email');
        Route::post('/password', [App\Http\Controllers\User\ProfileController::class, 'changePassword'])
            ->name('.password');
        Route::post('/delete', [App\Http\Controllers\User\ProfileController::class, 'remove'])
            ->name('.delete');
    });

// Backend
Route::group([
    'prefix' => 'a',
    'as' => 'backend',
    'middleware' => ['auth', 'admin'],
],
    function () {
        Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'show']);

        Route::group([
            'prefix' => 'users',
            'as' => '.users',
        ],
            function () {
                Route::get('/', [App\Http\Controllers\Backend\UsersController::class, 'index']);
                Route::get('/create', [App\Http\Controllers\Backend\UsersController::class, 'create'])
                    ->name('.create');
                Route::post('/', [App\Http\Controllers\Backend\UsersController::class, 'store'])
                    ->name('.store');
                Route::get('/{user}/edit', [App\Http\Controllers\Backend\UsersController::class, 'edit'])
                    ->name('.edit');
                Route::patch('/{user}', [App\Http\Controllers\Backend\UsersController::class, 'update'])
                    ->name('update');
                Route::patch('/{user}/toggle-bn', [App\Http\Controllers\Backend\UsersController::class, 'toggleBrowserNotification'])
                    ->name('.toggle-bn');
                Route::patch('/{user}/toggle-en', [App\Http\Controllers\Backend\UsersController::class, 'toggleEmailNotification'])
                    ->name('.toggle-bn');
            });
    });
