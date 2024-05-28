<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Http\Requests\NovaRequest;

class Coupon extends Resource
{
     /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Coupon>
     */
    public static $model = \App\Models\Coupon::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'code';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'code', 'type', 'expiry_date', 'status', 'discount'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Code'),

            Select::make('Discount Type')->options([
                'f' => 'Fixed',
                'r' => 'Ratio',
            ])->displayUsingLabels(),

            Number::make('Limit User')->nullable(),

            BelongsTo::make('User', 'user', User::class)->nullable(),

            Date::make('Start Date'),
            Date::make('End Date'),


            Select::make('Is Active')->options([
                'A' => 'Active',
                'I' => 'Inactive',
            ])->displayUsingLabels()->hideWhenCreating(),

            Text::make('Discount')->default(0.0)->nullable(),

            Boolean::make('Active', function () {
                return $this->status == 'A';
            }),

            Boolean::make('Deleted', 'deleted_at')->onlyOnIndex(),

            Boolean::make('Force Delete', 'forceDelete')->onlyOnIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
