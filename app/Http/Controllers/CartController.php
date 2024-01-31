<?php

namespace App\Http\Controllers;

use App\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request)
    {
        Cart::add('1', 'prode1', 122, 21);
    }

    public function remove(Request $request)
    {
        Cart::remove('3');
    }
    public function total(Request $request)
    {

        return Cart::total();
    }
    public function content(Request $request)
    {
        dd(Cart::content());
    }
}
