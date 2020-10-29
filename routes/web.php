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

// User Notifications
Route::group([
    'prefix' => 'notifications',
    'as' => 'notifications',
    'middleware' => ['auth', 'verified']
],
    function () {
        Route::get('/', [App\Http\Controllers\User\UserNotificationsController::class, 'index']);
        Route::delete('/{notification}', [App\Http\Controllers\User\UserNotificationsController::class, 'remove'])
            ->name('.delete');
    });

// Locomotive applications
Route::group([
    'prefix' => 'applications',
    'as' => 'applications',
    'middleware' => ['auth', 'verified'],
],
    function() {
        Route::get('/', [App\Http\Controllers\LocomotiveApplicationsController::class, 'index']);
        Route::get('/create', [App\Http\Controllers\LocomotiveApplicationsController::class, 'create'])
            ->middleware(['can:create-app'])
            ->name('.create');
        Route::post('/', [App\Http\Controllers\LocomotiveApplicationsController::class, 'store'])
            ->middleware(['can:create-app'])
            ->name('.store');
        Route::get('/{application}/edit', [App\Http\Controllers\LocomotiveApplicationsController::class, 'edit'])
            ->middleware(['can:edit-app,application'])
            ->name('.edit');
        Route::patch('/{application}', [App\Http\Controllers\LocomotiveApplicationsController::class, 'update'])
            ->middleware(['can:edit-app,application'])
            ->name('.update');
        Route::delete('/{application}', [App\Http\Controllers\LocomotiveApplicationsController::class, 'remove'])
            ->middleware(['can:edit-app,application'])
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
                    ->name('.update');
                Route::patch('/{user}/toggle-bn', [App\Http\Controllers\Backend\UsersController::class, 'toggleBrowserNotification'])
                    ->name('.toggle-bn');
                Route::patch('/{user}/toggle-en', [App\Http\Controllers\Backend\UsersController::class, 'toggleEmailNotification'])
                    ->name('.toggle-bn');
                Route::post('/verify', [App\Http\Controllers\Backend\UsersController::class, 'verify'])
                    ->name('.verify');
                Route::post('/change-password', [App\Http\Controllers\Backend\UsersController::class, 'changePassword'])
                    ->name('.change-password');
                Route::post('/delete', [App\Http\Controllers\Backend\UsersController::class, 'remove'])
                    ->name('.delete');
            });

        Route::group([
            'prefix' => 'purposes',
            'as' => '.purposes'
        ],
            function () {
                Route::get('/', [App\Http\Controllers\Backend\PurposesController::class, 'index']);
                Route::get('/create', [App\Http\Controllers\Backend\PurposesController::class, 'create'])
                    ->name('.create');
                Route::get('/{purpose}/edit', [App\Http\Controllers\Backend\PurposesController::class, 'edit'])
                    ->name('.edit');
                Route::post('/', [App\Http\Controllers\Backend\PurposesController::class, 'store'])
                    ->name('.store');
                Route::patch('/{purpose}', [App\Http\Controllers\Backend\PurposesController::class, 'update'])
                    ->name('.update');
                Route::delete('/{purpose}', [App\Http\Controllers\Backend\PurposesController::class, 'remove'])
                    ->name('.delete');
            });

        Route::group([
            'prefix' => 'customers',
            'as' => '.customers'
        ],
            function () {
                Route::get('/', [App\Http\Controllers\Backend\CustomersController::class, 'index']);
                Route::get('/create', [App\Http\Controllers\Backend\CustomersController::class, 'create'])
                    ->name('.create');
                Route::get('/{customer}/edit', [App\Http\Controllers\Backend\CustomersController::class, 'edit'])
                    ->name('.edit');
                Route::post('/', [App\Http\Controllers\Backend\CustomersController::class, 'store'])
                    ->name('.store');
                Route::patch('/{customer}', [App\Http\Controllers\Backend\CustomersController::class, 'update'])
                    ->name('.update');
                Route::delete('/{customer}', [App\Http\Controllers\Backend\CustomersController::class, 'remove'])
                    ->name('.delete');
            });

        Route::group([
            'prefix' => 'depots',
            'as' => '.depots'
        ],
            function () {
                Route::get('/', [App\Http\Controllers\Backend\DepotsController::class, 'index']);
                Route::get('/create', [App\Http\Controllers\Backend\DepotsController::class, 'create'])
                    ->name('.create');
                Route::get('/{depot}/edit', [App\Http\Controllers\Backend\DepotsController::class, 'edit'])
                    ->name('.edit');
                Route::post('/', [App\Http\Controllers\Backend\DepotsController::class, 'store'])
                    ->name('.store');
                Route::patch('/{depot}', [App\Http\Controllers\Backend\DepotsController::class, 'update'])
                    ->name('.update');
                Route::delete('/{depot}', [App\Http\Controllers\Backend\DepotsController::class, 'remove'])
                    ->name('.delete');
            });
    });
