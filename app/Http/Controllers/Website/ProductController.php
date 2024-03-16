<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $products = Product::paginate(10);
        $links = [
            '#' => 'products',
            route('products.index') => 'products List',
        ];
        $data = [
            'page_title' => 'products List',
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data'=>$products
           ];

           return Inertia::render('product', compact('data') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $links = [
            '#' => 'products',
            route('products.index') => 'products List',
            route('products.show', ['product' => $product->id])=> $product->name,

        ];
        $data = [
            'page_title' =>  $product->name,
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data'=>$product,
            'rates'=>$product->rates,
            'rates_count' =>  $product->rates()->count(),
            'average_rating' =>  $product->averageRating(),
            'Related Products'=>$product->getRelatedProducts(),



           ];

           return Inertia::render('product', compact('data') );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
