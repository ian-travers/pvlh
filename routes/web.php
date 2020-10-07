<?php

Route::get('/', function () {
    return view('welcome');
});

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

// Backend dashboard
Route::group([
    'prefix' => 'a',
    'as' => 'backend',
    'middleware' => ['auth', 'admin'],
],
    function () {
        Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'show']);

        Route::group([
            'prefix' => 'users',
            'as' => 'users',
        ],
            function () {
                Route::post('/', [App\Http\Controllers\Backend\UsersController::class, 'store'])
                    ->name('.store');
            });
    });
