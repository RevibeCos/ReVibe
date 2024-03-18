<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\cart;
use App\Facades\Cart as shopCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cart $cart)
    {
        //
    }


    public function add(Request $request)
    {
        shopCart::add('1', 'prode1', 122, 21);
    }

    public function remove(Request $request)
    {
        shopCart::remove('3');
    }
    public function total(Request $request)
    {

        return shopCart::total();
    }
    public function content(Request $request)
    {
        dd(shopCart::content());
    }
}
