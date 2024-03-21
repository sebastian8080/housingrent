<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;

Route::get('/properties', [HomeController::class, 'index'])->name('properties.index');
Route::get('/property/create', [HomeController::class, 'create'])->name('propertie.create');


Route::get('/getcities/{state_id}', [HomeController::class, 'getcities'])->name('get.cities');