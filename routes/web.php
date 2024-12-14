<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/basket',[BasketController::class, 'get'])->name('basket');
    Route::get('/campaigns',[CampaignController::class, 'index'])->name('menu.campaigns');
    Route::get('/campaigns/{id}',[CampaignController::class, 'get'])->name('campaigns.get');
    Route::put('/campaigns/{id}',[CampaignController::class, 'update'])->name('campaigns.update');
    Route::put('/basket/{id}',[BasketController::class, 'add'])->name('basket.add');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/basket/remove/{id}', [BasketController::class, 'remove'])->name('basket.remove');
    Route::put('order', [OrderController::class, 'order'])->name('order');
});

require_once __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
