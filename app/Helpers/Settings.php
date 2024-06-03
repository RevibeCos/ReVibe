<?php

namespace App\Helpers;

use App\Nova\Admin;
use App\Nova\Attribute;
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
use App\Nova\Page;
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
use Whitecube\NovaFlexibleContent\Flexible;
use Eminiarts\Tabs\Tabs;


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
                    MenuItem::resource(Attribute::class),
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
                    MenuItem::resource(Page::class),
                    MenuItem::link('Setting', '/nova-settings/setting'),


                    // MenuItem::link('Header', '/nova-settings/header'),
                    // MenuItem::link('Footer', '/nova-settings/footer'),
                    // MenuItem::link('Our Story', '/nova-settings/our-story'),

                ])->icon('cog')->collapsable()


            ];
        });

        NovaSettings::addSettingsFields([
            new Tabs(
                __('Tabs'),
                [

                    __('header') => [
                        Image::make('Logo', 'logo'),
                        Image::make('Black Logo', 'Black_logo'),

                        Flexible::make('Nav item')
                            ->addLayout('Add Item', 'item', [
                                Text::make('Title'),
                                Text::make('Link'),

                                Image::make('Logo', 'logo'),

                            ])->button('Add Item'),



                    ],   __('Footer') => [
                        Image::make('image', 'image'),

                        Text::make('Text', 'text_footer'),
                        Text::make('Sup Text', 'sup_text_footer')->placeholder('Ramat aviv c, TLV'),



                    ] , __('Social media') => [
                        Text::make('Facebook', 'facebook')->placeholder('https://facebook.com/USERNAME'),
                        Text::make('Instagram', 'instagram')->placeholder('https://instagram.com/USERNAME'),
                        Text::make('Whatsapp', 'whatsapp')->placeholder('+972521234567'),
                        Text::make('Email', 'email')->placeholder('Ramat aviv c, TLV'),


                    ] ,
                ]
            ),

        ], [], 'Setting');



        // Nova::enableRTL();

        // Nova::enableRTL(fn (Request $request) => $request->user()->wantsRTL());

    }
}
