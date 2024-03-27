<?php

namespace App\Providers;

use App\Models\Category;
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
            $locale = config('app.locale');
            $view->with([
                'locale' => $locale,
            ]);
        });
        View::composer('*', function ($view) {
            $logo = nova_get_setting('logo');
            $nav_item = json_decode(nova_get_setting('nav_item'));
            $item = [];
            if (is_array($nav_item)) {
                $item = array_map(function ($item) {
                    return $item->attributes;
                }, $nav_item);
            }

            $social = [
                'Facebook'   =>  nova_get_setting('facebook', 'https://www.facebook.com/'),
                'Instagram'   => nova_get_setting('instagram', 'https://www.instagram.com/'),
                'Whatsapp'   => nova_get_setting('whatsapp', '+972 54-839-2252'),
                'Address'   => nova_get_setting('address', 'default_value'),
            ];
           $categories= Category::all();
            $view->with([
                'logo' => $logo,
                'social' => $social,
                'item' => $item,
                'categories' => $categories,
            ]);
        });
        View::composer('*', function ($view) {
            $logo = nova_get_setting('logo');
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
