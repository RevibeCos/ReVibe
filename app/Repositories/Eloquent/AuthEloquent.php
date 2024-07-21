<?php


namespace App\Repositories\Eloquent;

use App\Models\Admin;
use App\Models\Brand;
use App\Repositories\Interfaces\Repository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\Tag;
use App\Repositories\Interfaces\AdminRepository;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AuthEloquent implements AdminRepository
{
    public function login(array $attributes)
    {

        $admin = Admin::where('email', $attributes['email'])->first();
        // dd($admin);
        if (!$admin || !Hash::check($attributes['password'], $admin->password)) {
            return response([
                'message' => 'pad'
            ], 401);
        }
        $token = $admin->createToken('Revibe')->plainTextToken;
        $response = [
            'user' => $admin,
            'token' => $token
        ];

        return response($response, 201);

        $response = [
            'user' => $admin,
            'token' => $token
        ];

        return response($response, 201);
    }
    public function register(array $attributes)
    {
        try {

            DB::beginTransaction();
            $admin = new Admin();
            $admin->name = $attributes['name'];
            $admin->username = $attributes['username'];
            $admin->email = $attributes['email'];
            $admin->phone_number = $attributes['phone_number'];
            $admin->password = bcrypt($attributes['password']);
            $admin->save();

            $admin->image = isset($attributes['image']) ? storePhoto('Admin', $attributes['image']) : '';
            DB::commit();
            $token = $admin->createToken('Revibe')->plainTextToken;
            $response = [
                'user' => $admin,
                'token' => $token
            ];
            return response($response, 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
