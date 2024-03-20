<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
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
            'products' => $products
        ];

        return Inertia::render('product', compact('data'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show(Product $product)
    {

        $links = [
            '#' => 'products',
            route('products.index') => 'products List',
            route('products.show', $product->id) => $product->name,

        ];
        $data = [
            'page_title' => $product->name,
            'icon' => 'fas fa-user-tie',
            'links' => $links,
            'data' => $product,
            'rates' => $product->rates,
            'rates_count' => $product->rates()->count(),
            'average_rating' => $product->averageRating(),
            'Related Products' => $product->getRelatedProducts(),


        ];

        return Inertia::render('product', compact('data'));
    }

    public function edit(Product $product)
    {
        //
    }

    public function update(Request $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        //
    }
}
