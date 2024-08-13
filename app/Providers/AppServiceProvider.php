<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Inertia::share('props', function () {
            return [
                'locale' => config('app.locale'),
            ];
        });
    }

    public function boot(): void
    {
        //
    }
}
