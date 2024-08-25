<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\WebSiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/category/{id}/products', [HomeController::class, 'getCategoryProducts']);
Route::get('/companies', [HomeController::class, 'getCompanies']);




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/favorite', [ProfileController::class, 'getFavorite'])->name('favorite.get');

    Route::get('/add-new-address', [ProfileController::class, 'addAddresses']);
    Route::get('/update_address', [ProfileController::class, 'updateAddress']);
    Route::get('/get-address', [ProfileController::class, 'getAddress'])->name('address.get');

});
Inertia::share('appName', config('app.name'));

require __DIR__ . '/auth.php';



Route::get('/google/redirect', [AuthenticatedSessionController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [AuthenticatedSessionController::class, 'handleGoogleCallback'])->name('google.callback');
Route::get('/auth/facebook', [AuthenticatedSessionController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [AuthenticatedSessionController::class, 'handleFacebookCallback']);

Route::get('/apple/redirect', [AuthenticatedSessionController::class, 'redirectToApple'])->name('apple.redirect');
Route::get('/apple/callback', [AuthenticatedSessionController::class, 'handleAppleCallback'])->name('apple.callback');

