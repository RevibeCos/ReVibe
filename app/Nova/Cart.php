<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\{ID, BelongsTo, BelongsToMany, Text, Number, DateTime, Currency, HasMany, MorphToMany, Tag};
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

            Text::make('Price')->sortable(),

            Number::make('Discount')->sortable(),

            Text::make('Total Price')->sortable(),


            Text::make('Delivery Cost')->sortable(),

            // BelongsToMany::make(__('product'), 'products', product::class)
            // ->searchable()
            // ->showCreateRelationButton(),
            // Tag::make('products')->modalSize('7xl')->withPreview()->displayAsList()->showCreateRelationButton()->preload() ->fields(function ($request, $relatedModel) {
            //     return [
            //         Text::make('Notes'),
            //     ];
            // }) ,
            belongsToMany::make('products')
            ->fields(function ($request, $relatedModel) {
                return [
                    Text::make('price'),
                    Text::make('quantity'),
                ];
            }),


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
