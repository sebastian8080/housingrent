<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;

    Route::get('/properties/list', [HomeController::class, 'index'])->name('properties.index');
    Route::get('/property/create', [HomeController::class, 'create'])->name('property.create');
    Route::post('/properties/store', [HomeController::class, 'store'])->name('properties.store');
    Route::get('/properties/{id}/upload', [HomeController::class, 'upload'])->name('properties.upload');
    Route::post('/properties/{id}/upload', [HomeController::class, 'upload_images'])->name('properties.upload.images');
    Route::post('/properties/image/delete', [HomeController::class, 'deleteImage'])->name('properties.deleteImage');
    Route::get('/properties/{id}/images', [HomeController::class, 'showImages'])->name('properties.showImages');


    Route::get('/getcities/{state_id}', [HomeController::class, 'getcities'])->name('get.cities');
    Route::get('/getparishes/{city_id}', [HomeController::class, 'getparishes'])->name('get.parishes');
    // Añade aquí otras rutas de administración.