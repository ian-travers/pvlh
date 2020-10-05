<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');

Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'show'])
    ->middleware(['auth'])
    ->name('profile');

Route::post('/profile', [App\Http\Controllers\User\ProfileController::class, 'update'])
    ->middleware(['auth', 'verified'])
    ->name('profile.update');

Route::post('/profile/email', [App\Http\Controllers\User\ProfileController::class, 'changeEmail'])
    ->middleware(['auth'])
    ->name('profile.email');

Route::post('/profile/password', [App\Http\Controllers\User\ProfileController::class, 'changePassword'])
    ->middleware(['auth'])
    ->name('profile.password');
