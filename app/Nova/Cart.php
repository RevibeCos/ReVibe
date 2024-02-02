<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{ID, BelongsTo, Text, Number, DateTime, Currency, HasMany};
use Laravel\Nova\Http\Requests\NovaRequest;

class Cart extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Cart>
     */
    public static $model = \App\Models\Cart::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User', 'user', User::class)->searchable(),

            Text::make('Session ID')->sortable(),

            Text::make('Status')->sortable(),

            Currency::make('Price')->sortable(),

            Number::make('Discount')->sortable(),

            Currency::make('Total Price')->sortable(),


            Currency::make('Delivery Cost')->sortable(),

            // BelongsTo::make('Coupon', 'coupon', Coupon::class)->nullable()->searchable(),

            // DateTime::make('Created At')->format('YYYY-MM-DD HH:mm:ss')->sortable(),

            // DateTime::make('Updated At')->format('YYYY-MM-DD HH:mm:ss')->sortable(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
