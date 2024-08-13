<?php

namespace App\Http\Controllers\Website;

use App\Enums\PageTypes;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CompanyResource;
use App\Http\Resources\CurrencyResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PageResource;
use App\Http\Resources\ProductDetailResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SliderResource;
use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\Favorite;
use App\Models\Offer;
use App\Models\Page;
use App\Models\Product;
use App\Models\ProductRate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {

        $data = [
            'page_title' => 'Home',
            'icon' => 'fas fa-user-tie',
            'currency' => CurrencyResource::collection(Currency::all()),
            'slider' => SliderResource::collection(Page::where('type', PageTypes::sliderValue())->take(6)->get()),
            'categories' => CategoryResource::collection(Category::with('children')->whereNull('parent_id')->latest()->take(4)->get()),
            'offers' => OfferResource::collection(Offer::latest()->take(2)->get()),
            'special_products' => ProductResource::collection(Product::where('in_home', 1)->take(6)->get()),
            'top_seller_products' => ProductResource::collection(Product::select('products.id', 'products.name', DB::raw('SUM(cart_products.quantity) as total_quantity'))
                ->join('cart_products', 'products.id', '=', 'cart_products.product_id')
                ->groupBy('products.id', 'products.name')
                ->orderByDesc('total_quantity')
                ->get()),
            'newest_products' => ProductResource::collection(Product::latest()->take(10)->get()),
            'company' => CompanyResource::collection(Company::latest()->take(10)->get()),
            'our_story' => PageResource::collection(Page::where('type', PageTypes::ourStoryValue())->take(2)->get()),
        ];
        // return $data;
        return Inertia::render('Home', $data);
    }

    public function favorite()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return response($favorites, 201);
    }

    public function getCategoryProducts(Request $request, $id)
    {
        $attributes = $request->all();
        $page_size = isset($attributes['page_size']) ? $attributes['page_size'] : max_pagination();
        $page_number = isset($attributes['page_number']) ? $attributes['page_number'] : 1;

        $category = Category::findOrFail($id);
        $query = $category->products();

        if (isset($attributes['newest']) && !empty($attributes['newest'])) {
            $query = $query->latest();
        }
        if (isset($attributes['higher']) && !empty($attributes['higher'])) {
            $query = $query->orderBy('website_price', 'desc');
        }
        if (isset($attributes['lower']) && !empty($attributes['lower'])) {
            $query = $query->orderBy('website_price', 'asc');
        }
        if (isset($attributes['name']) && !empty($attributes['name'])) {
            $query = $query->where('name', 'like', '%' . $attributes['name'] . '%');
        }

        $count = $query->count();
        $page_count = page_count($count, $page_size);
        $page_number = max(0, $page_number - 1);
        $page_number = min($page_number, $page_count - 1);

        $products = ProductResource::collection($query->skip($page_number * $page_size)->take($page_size)->get());

        return response_api(true, 200, null, $products, $page_count, $page_number, $count);
    }
    public function productsDetails(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $categoryIds = $product->categories->pluck('id')->toArray();
        $tagIds = $product->tags->pluck('id')->toArray();

        $relatedProducts = Product::whereHas('categories', function ($query) use ($categoryIds) {
            $query->whereIn('categories.id', $categoryIds);
        })
            ->orWhereHas('tags', function ($query) use ($tagIds) {
                $query->whereIn('tags.id', $tagIds);
            })
            ->where('id', '!=', $product->id)
            ->get();

        $response['product'] = new ProductDetailResource($product);
        $response['relatedProducts'] = ProductResource::collection($relatedProducts);

        return response_api(true, 200, null, $response);
    }
    public function addRate(Request $request)
    {
        $rate = new ProductRate();
        $rate->product_id = $request->id;
        $rate->rate = $request->rate;
        $rate->comment = $request->comment;
    }
    public function deleteRate(Request $request)
    {
        $rate =  ProductRate::findOrFail($request->id);
        if (isset($rate) && $rate->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);
    }

    public function getCompanies(Request $request)
    {

        $attributes = $request->all();


        $pageSize = isset($attributes['page_size']) ? (int)$attributes['page_size'] : max_pagination();
        $pageNumber = isset($attributes['page_number']) ? (int)$attributes['page_number'] : 1;


        $query = Company::query();


        if (isset($attributes['name']) && !empty($attributes['name'])) {
            $query->where('name', 'like', '%' . $attributes['name'] . '%')
                ->orWhereHas('products', function ($query) use ($attributes) {
                    $query->where('name', 'like', '%' . $attributes['name'] . '%');
                });
        }


        $total = $query->count();


        $pageCount = ceil($total / $pageSize);


        $pageNumber = max(1, min($pageNumber, $pageCount));


        $companies = CompanyResource::collection($query->latest()
            ->skip(($pageNumber - 1) * $pageSize)
            ->take($pageSize)
            ->get());


        return response_api(true, 200, null, $companies, $pageCount, $pageNumber, $total);
    }
}
