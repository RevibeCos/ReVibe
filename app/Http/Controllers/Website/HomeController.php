<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {


        $data = [
            'page_title' => 'Home',
            'icon' => 'fas fa-user-tie',
            'slider' => Page::where('type', '1')->get(),
            'categories' => Category::where('parent_id', null)->latest()->take(4)->get(),
            'supCategories' => Category::whereHas('parent', function ($query) {
                $query->whereNull('parent_id');
            })->get(),
            'offers' => Offer::latest()->take(2)->get(),
            'specialProducts' => Product::where('in_home', 1)->get(),
            'topSellerProducts' => Product::select('products.id', 'products.name', DB::raw('SUM(cart_product.quantity) as total_quantity'))
                ->join('cart_product', 'products.id', '=', 'cart_product.product_id')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_quantity')
                ->get(),
            'newestProducts' => Product::orderBy('created_at', 'desc')->take(10)->get(),
            'Companies' => Company::all(),
        ];

        return Inertia::render('Home', $data);
    }
}
