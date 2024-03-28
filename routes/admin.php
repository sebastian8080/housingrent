<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;

    Route::get('/properties/list', [HomeController::class, 'index'])->name('properties.index');
    Route::get('/property/create', [HomeController::class, 'create'])->name('property.create');
    Route::post('/properties/store', [HomeController::class, 'store'])->name('properties.store');
    Route::get('/properties/{id}/upload', [HomeController::class, 'upload'])->name('properties.upload');
    Route::post('/properties/{id}/upload', [HomeController::class, 'upload_images'])->name('properties.upload.images');
    Route::post('/properties/image/delete', [HomeController::class, 'deleteImage'])->name('properties.deleteImage');
    Route::get('/properties/{id}/images', [HomeController::class, 'showImages'])->name('properties.showImages');
    Route::get('/properties/{id}/edit', [HomeController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{id}/upload', [HomeController::class, 'update'])->name('properties.update');
    Route::delete('/properties/delete/{id}', [HomeController::class, 'destroy'])->name('properties.destroy');




    Route::get('/getcities/{state_id}', [HomeController::class, 'getcities'])->name('get.cities');
    Route::get('/getparishes/{city_id}', [HomeController::class, 'getparishes'])->name('get.parishes');



    Route::get('/user/edit', [UserController::class, 'edit'])->name('users.edit'); // Vista para editar
    Route::put('/user/update', [UserController::class, 'update'])->name('users.update'); // Procesar los cambios
    Route::get('/user/password/change', [UserController::class, 'showChangePasswordForm'])->name('user.password.change');
    Route::post('/user/password/change', [UserController::class, 'changePassword'])->name('user.password.update');
    


    
    // Añade aquí otras rutas de administración.