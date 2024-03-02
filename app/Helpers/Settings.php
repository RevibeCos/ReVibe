<?php

namespace App\Helpers;

use App\Nova\Admin;
use App\Nova\Cart;
use App\Nova\Category;
use App\Nova\Company;
use App\Nova\Dashboards\Main;
use App\Nova\Favorite;
use App\Nova\Product;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Outl1ne\NovaSettings\NovaSettings;

class Settings {
    public static function init() {

        Nova::withBreadcrumbs();
        Nova::footer(function ($request) {
            return Blade::render('');
        });

        // Nova::mainMenu(function (Request $request) {
        //     return [
        //         MenuSection::dashboard(Main::class)->icon('chart-bar'),


        //         MenuSection::make('Customers', [
        //             MenuItem::resource(Admin::class),
        //             MenuItem::resource(User::class),
        //             MenuItem::resource(Company::class),
        //             MenuItem::resource(Category::class),
        //             MenuItem::resource(Product::class),

        //         ])->icon('user')->collapsable(),


        //     ];
        // });

        NovaSettings::addSettingsFields([
            Text::make('Some setting', 'some_setting'),
            Number::make('A number', 'a_number'),
        ], [], 'General');

        NovaSettings::addSettingsFields([
            Text::make('Some setting', 'some_setting'),
            Number::make('A number', 'a_number'),
        ], [], 'Subpage');
           // Nova::enableRTL();

        // Nova::enableRTL(fn (Request $request) => $request->user()->wantsRTL());

    }

}
