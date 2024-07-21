<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\{BelongsTo, BelongsToMany, ID,Text,Image,Number,Boolean,Select,Currency,BooleanGroup, Tag};

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

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


        Text::make('Name'),

        Text::make('Description'),


        Number ::make('Website Price'),
        Number ::make('Cost Price'),
        Number ::make('Full Price'),

        Image::make('Image'),
        Image::make(__('Hover Image')),

        // Currency::make('Full Price')->currency('USD'),

        // Currency::make('Price')->currency('USD'),

        // Number::make('Discount')->step(0.01),

        Boolean::make('Is New'),



        BelongsTo::make(__('company'), 'company', company::class)

        ->noPeeking()
        ->showCreateRelationButton(),

        BelongsToMany::make(__('categories'), 'categories', Category::class)
        ->searchable()

        ->showCreateRelationButton(),

        BelongsToMany::make(__('attributes'), 'attributes', attribute::class)->fields(function () {
            return [
                // Number::make('price', 'price'),
                Text::make(__('limit'), 'limit')
                    ->translatable(),
            ];
        })
        ->searchable()

        ->showCreateRelationButton(),

        // Tag::make('categories'),
        Tag::make('categories')->preload()->withPreview()->displayAsList()->showCreateRelationButton() ,
        Tag::make('attributes')->preload()->withPreview()->displayAsList()->showCreateRelationButton() ,

        Tag::make('tags')->preload()->withPreview()->displayAsList()->showCreateRelationButton() ,


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
