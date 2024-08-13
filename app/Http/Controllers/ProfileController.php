<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\Website\Address\AddressCreateRequest;
use App\Http\Requests\Website\Address\AddressUpdateRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\ProductResource;
use App\Models\Address;
use App\Models\Favorite;
use App\Models\Order;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }
    public function addAddresses(AddressCreateRequest $request)
    {
        try {

            DB::beginTransaction();
            $address = new Address();
            $address->user_id = Auth::id();
            $address->name = $request->name;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->phone_number = $request->phone_number;
            $address->save();
            DB::commit();
            return response_api(true, 200, __('app.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response_api(false, 422, __('app.error'), empObj());
        }
    }
    public function getAddress(Request $request)
    {
        $address = Address::where('user_id', Auth::id())->get();

        return response(AddressResource::collection($address), 201);
    }

    public function updateAddress(AddressUpdateRequest $request)
    {
        try {

            DB::beginTransaction();
            $address = Address::findOrFail($request->id);
            $address->name = $request->name;
            $address->city = $request->city;
            $address->state = $request->state;
            $address->phone_number = $request->phone_number;
            $address->save();
            DB::commit();
            return response_api(true, 200, __('app.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response_api(false, 422, __('app.error'), empObj());
        }
    }
    public function deleteAddress(Request $request)
    {

        $address = Address::findOrFail($request->id);
        if (isset($address) && $address->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);
    }
    public function getFavorite(Request $request)
    {
        dd(Auth::id());
        $collection = FavoriteResource::collection(Favorite::where('user_id', 1)->get());
        return response_api(false, 422, null, $collection);
    }
    public function addFavorite(Request $request)
    {
        try {
            DB::beginTransaction();
            $favorite = new Favorite();
            $favorite->user_id = Auth::id();
            $favorite->product_id = $request->product_id;
            $favorite->save();
            DB::commit();
            return response_api(true, 200, __('app.success'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return response_api(false, 422, __('app.error'), empObj());
        }
    }
    public function deleteFavorite($id)
    {
        $favorites = Favorite::findOrFail($id);
        if (isset($favorites) && $favorites->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);
    }
    public function deleteOrder($id)
    {
        $order = Order::findOrFail($id);
        if (isset($order) && $order->delete())
            return response_api(true, 200, trans('app.deleted'), []);
        return response_api(false, 422, null, []);
    }
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
