<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        View::composer('*', function ($view) {
            $logo = nova_get_setting('logo','sss');
            $image = nova_get_setting('image');
            $textFooter = nova_get_setting('text_footer');
            $supTextFooter = nova_get_setting('sup_text_footer');

            $view->with([
                'logo' => $logo,
                'image' => $image,
                'textFooter' => $textFooter,
                'supTextFooter' => $supTextFooter,
            ]);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
