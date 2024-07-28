<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;




Route::post('login', [AuthController::class, 'login']);


Route::post('register', [AuthController::class, 'register']);
