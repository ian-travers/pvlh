<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->middleware('verified')
    ->name('home');

Route::get('/profile', [App\Http\Controllers\User\ProfileController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('profile');
