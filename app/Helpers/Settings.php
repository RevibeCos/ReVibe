<?php

namespace App\Helpers;

use App\Nova\Cart;
use App\Nova\Dashboards\Main;
use App\Nova\Favorite;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;

class Settings {
    public static function init() {

        Nova::withBreadcrumbs();
        Nova::footer(function ($request) {
            return Blade::render('');
        });
        Nova::initialPath('/resources/users');

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),


                MenuSection::make('Customers', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(Favorite::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('Content', [
                    MenuItem::resource(Cart::class),
                ])->icon('document-text')->collapsable(),
            ];
        });
           // Nova::enableRTL();

        // Nova::enableRTL(fn (Request $request) => $request->user()->wantsRTL());

    }

}
