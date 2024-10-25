<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            class_basename(User::class) => User::class,
            class_basename(Project::class) => Project::class,
        ]);
    }
}
