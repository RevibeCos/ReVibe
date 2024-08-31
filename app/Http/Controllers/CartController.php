<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Facades\Cart;
use App\Models\Cart as ModelsCart;
use App\Models\CartProduct;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = ModelsCart::firstOrCreate([
                'user_id' => 1,
                'status' => '0',
            ]);
            $cartProduct = CartProduct::where('cart_id', $cart->id)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartProduct) {
                // If it exists, update the quantity and price
                $cartProduct->quantity += $request->quantity;
                $cartProduct->price = $request->price; // Optional: Update price if needed
                $cartProduct->save();
            } else {
                // If it doesn't exist, create a new entry
                $cartProduct = CartProduct::create([
                    'cart_id' => $cart->id,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $request->price,
                ]);
            }
            Cart::add($request->product_id, 'Product Name', $request->price, $request->quantity);
            DB::commit();
            return response()->json([
                'message' => __('Product added to cart successfully!'),
                'cartProduct' => $cartProduct,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => __('Failed to add product to cart.'),
                'error' => $th->getMessage(),
            ], 422);
        }
    }
    public function remove(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = ModelsCart::where('user_id', auth()->id())->where('status', '0')->firstOrFail();
            CartProduct::where('cart_id', $cart->id)->where('product_id', $request->product_id)->delete();
            Cart::remove($request->product_id);
            DB::commit();
            return response()->json([
                'message' => __('Product removed from cart successfully!'),
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => __('Failed to remove product from cart.'),
                'error' => $th->getMessage(),
            ], 422);
        }
    }
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $cart = ModelsCart::where('user_id', auth()->id())->where('status', '0')->firstOrFail();
            $cartProduct = CartProduct::where('cart_id', $cart->id)->where('product_id', $request->product_id)->firstOrFail();
            $action = $request->action;
            Cart::update($request->product_id, $action);
            if ($action == 'plus') {
                $cartProduct->quantity += 1;
            } elseif ($action == 'minus' && $cartProduct->quantity > 1) {
                $cartProduct->quantity -= 1;
            }
            $cartProduct->save();
            DB::commit();
            return response()->json([
                'message' => __('Cart updated successfully!'),
                'cartProduct' => $cartProduct,
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'message' => __('Failed to update cart.'),
                'error' => $th->getMessage(),
            ], 422);
        }
    }
    public function total(Request $request)
    {
        return response()->json([
            'total' => Cart::total(),
        ]);
    }
    public function content(Request $request)
    {
        return response()->json([
            'content' => Cart::content(),
        ]);
    }
}
