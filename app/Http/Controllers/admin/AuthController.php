<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\RegisterRequest;
use App\Repositories\Eloquent\AuthEloquent;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private $auth;

    public function __construct(AuthEloquent $auth)
    {
        $this->auth = $auth;
    }


    public function login(LoginRequest  $request)
    {
        return $this->auth->login($request->all());

    }


    public function register(RegisterRequest  $request)
    {
        return $this->auth->register($request->all());

    }

}
