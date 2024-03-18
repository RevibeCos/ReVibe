<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\CompanyController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Laravel\Nova\Notifications\NovaNotification;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test', function () {
    $user = User::find(2);
    $user->notify(new NovaNotification());
});

Route::get('/', [HomeController::class, 'home'])->name('profile.edit');



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard22');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::get('/Add_to_cart', [CartController::class, 'add']);
Route::get('/remove_to_cart', [CartController::class, 'remove']);
Route::get('/total_cart', [CartController::class, 'total']);
Route::get('/content_cart', [CartController::class, 'content']);



Route::resource('products', ProductController::class);

Route::resource('companies', CompanyController::class);
