<?php

use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/ads', [AdvertisementController::class, "index"])->name('adv_list');
Route::get('/ad/{id}', [AdvertisementController::class, "show"])->name('adv_list');
Route::get('/ads/filter', [AdvertisementController::class, "reload"])->name('adv_list');

Route::post('/create', [AdvertisementController::class, "create"])->name('create');
Route::delete('/delete/{id}', [AdvertisementController::class, "delete"])->name('delete');
Route::get('/edit/{id}', [AdvertisementController::class, 'loadUpdateForm'])->name('updateform');
Route::patch('/edit', [AdvertisementController::class, 'update'])->name('update');

Route::get('dashboard', [AdvertisementController::class, "dashboard"])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';