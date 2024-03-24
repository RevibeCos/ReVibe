<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Company;
use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{


    public function home()
    {

        $data = [
            'page_title' => 'Home',
            'icon' => 'fas fa-user-tie',
            'categories' => Category::getParentCategories(),
            'supCategories' => Category::getSupCategories(),
            'offers' => Offer::latest()->take(2)->get(),
            'specialProducts' => Product::all(),
            'topSellerProducts' => Product::all(),
            'newestProducts' => Product::all(),
            'Companies' => Company::all(),


        ];
        return Inertia::render('Home', $data);


    }

    public function dashboard()
    {
        $data = [
            'page_title' => 'products List',
            'icon' => 'fas fa-user-tie',
            // 'links' => $links,
            // 'data'=>$products
            'categories' => Category::getParentCategories(),
            'supCategories' => Category::getSupCategories(),
            'offers' => Offer::latest()->take(2)->get(),
            'specialProducts' => Product::getSpecialProducts(),
            'topSellerProducts' => Product::getTopSellerProducts(),
            'newestProducts' => Product::getNewestProducts(),
            'Companies' => Company::all(),

        ];
        return Inertia::render('Dashboard', $data);
    }
}
