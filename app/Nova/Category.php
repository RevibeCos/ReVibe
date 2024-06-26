<?php

namespace App\Nova;

use Ganyicz\NovaCallbacks\HasCallbacks;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\{BelongsTo, DateTime, HasMany, ID, Text, Image, Number};
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaTranslatable\HandlesTranslatable;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Category extends Resource
{

    use HandlesTranslatable;

    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Category>
     */
    public static $model = \App\Models\Category::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

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

            Text::make('Name')
                ->rules('required', 'min:2')
                ->translatable(),
            Text::make('Description', 'description')
                ->rules('required', 'min:2')
                ->translatable(),

            Image::make('image'),

            BelongsTo::make('Parent', 'parent', Category::class)->nullable(),
            HasMany::make('children', 'children', Category::class)->nullable(),


            DateTime::make('Created At')->sortable()->hideWhenCreating()->hideWhenUpdating(),

            DateTime::make('Updated At')->sortable()->hideWhenCreating()->hideWhenUpdating(),
        ];
    }
    protected static function fillFields(NovaRequest $request, $model, $fields)
    {
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $fillFields = parent::fillFields($request, $model, $fields);
        $modelObject = $fillFields[0];
        $modelObject['image'] = $uploadedFileUrl;
        return $fillFields;
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
