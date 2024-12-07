<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(base_path('routes/auth.php'));

        Route::middleware(['auth:api'])
            ->prefix('projects')
            ->name('project.')
            ->group(base_path('routes/project.php'));

        Route::middleware(['auth:api'])
            ->prefix('tasks')
            ->name('task.')
            ->group(base_path('routes/task.php'));
    }
}
