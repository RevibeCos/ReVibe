<?php

namespace App\Helpers;

use App\Nova\Admin;
use App\Nova\Cart;
use App\Nova\Category;
use App\Nova\City;
use App\Nova\Company;
use App\Nova\Coupon;
use App\Nova\Dashboards\Main;
use App\Nova\Favorite;
use App\Nova\FormMessage;
use App\Nova\Offer;
use App\Nova\Order;
use App\Nova\Product;
use App\Nova\Tag;
use App\Nova\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Outl1ne\NovaSettings\NovaSettings;

class Settings
{
    public static function init()
    {

        Nova::withBreadcrumbs();
        Nova::footer(function ($request) {
            return Blade::render('');
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),


                MenuSection::make('Admin', [
                    MenuItem::externalLink('Task Manger', 'https://task-manger.sadeemlanding.com/')->openInNewTab(),
                    MenuItem::resource(Admin::class),
                ])->icon('user')->collapsable(),

                MenuSection::make('products', [
                    MenuItem::resource(Company::class),
                    MenuItem::resource(Category::class),
                    MenuItem::resource(Tag::class),
                    MenuItem::resource(Product::class),
                    MenuItem::resource(Offer::class),

                ])->icon('view-grid')->collapsable(),


                MenuSection::make('Customers', [
                    MenuItem::resource(User::class),
                    MenuItem::resource(City::class),
                    MenuItem::resource(FormMessage::class),


                ])->icon('user-group')->collapsable(),

                MenuSection::make('Order', [
                    MenuItem::resource(Cart::class),
                    MenuItem::resource(Order::class),
                    MenuItem::resource(Coupon::class),

                ])->icon('clipboard-check')->collapsable(),

                MenuSection::make('Setting', [
                    MenuItem::link('Header', '/nova-settings/header'),
                    MenuItem::link('Footer', '/nova-settings/footer'),
                    MenuItem::link('Our Story', '/nova-settings/our-story'),

                ])->icon('user')->collapsable()


            ];
        });

        NovaSettings::addSettingsFields([
            Image::make('Our Mission Image', 'our_mission_image'),
            Number::make('Our Mission Text', 'our_mission_text'),
            Image::make('Our vision Image', 'our_vision_image'),
            Number::make('Our vision Text', 'our_vision_text'),
        ], [], 'Our Story');
        NovaSettings::addSettingsFields([
            Image::make('Our Mission Image', 'our_mission_image'),
            Number::make('Our Mission Text', 'our_mission_text'),
            Image::make('Our vision Image', 'our_vision_image'),
            Number::make('Our vision Text', 'our_vision_text'),
        ], [], 'Header');
        NovaSettings::addSettingsFields([
            Image::make('Our Mission Image', 'our_mission_image'),
            Number::make('Our Mission Text', 'our_mission_text'),
            Image::make('Our vision Image', 'our_vision_image'),
            Number::make('Our vision Text', 'our_vision_text'),
        ], [], 'Footer');


        // Nova::enableRTL();

        // Nova::enableRTL(fn (Request $request) => $request->user()->wantsRTL());

    }
}
