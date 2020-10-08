<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        view()->composer('components.backend-left-sidebar', function (View $view) {
            [$controller, $action] = explode('@', class_basename(\Route::getCurrentRoute()->action['controller']));

            return $view->with(compact('controller', 'action'));
        });
    }
}
