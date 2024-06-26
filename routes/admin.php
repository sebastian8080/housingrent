<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AsesorController;
use App\Http\Controllers\Admin\AdminController;
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
    Route::post('/properties/{id}/change-status', [HomeController::class, 'changeStatus'])->name('properties.change.status');
    Route::post('/properties/{id}/change-availability', [HomeController::class, 'changeAvailable'])->name('properties.change.availability');



    Route::get('/getcities/{state_id}', [HomeController::class, 'getcities'])->name('get.cities');
    Route::get('/getparishes/{city_id}', [HomeController::class, 'getparishes'])->name('get.parishes');



    Route::get('/user/edit', [UserController::class, 'edit'])->name('users.edit'); // Vista para editar
    Route::put('/user/update', [UserController::class, 'update'])->name('users.update'); // Procesar los cambios
    Route::get('/user/password/change', [UserController::class, 'showChangePasswordForm'])->name('user.password.change');
    Route::post('/user/password/change', [UserController::class, 'changePassword'])->name('user.password.update');


    Route::get('/propiedades/preview/{slug}', [HomeController::class, 'preview'])->name('show.preview');

    Route::middleware(['can:is-admin'])->group(function () {
        Route::get('/users/list', [AdminController::class, 'list_users'])->name('users.list');
        Route::get('/users/list/search', [AdminController::class, 'ajaxListUsers'])->name('users.ajaxListUsers');

        Route::put('/users/{user}/role', [AdminController::class, 'updateRole'])->name('users.updateRole');
        Route::put('/users/{user}/isActive', [AdminController::class, 'updateIsActive'])->name('users.updateIsActive');
        Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.admin.edit');
        Route::put('/users/{user}/update', [AdminController::class, 'update'])->name('users.admin.update');
        Route::delete('users/{user}/delete', [AdminController::class, 'destroy'])->name('users.destroy');


        Route::get('/services/list', [AdminController::class, 'list_services'])->name('services.list');
        Route::get('/services/list/search', [AdminController::class, 'ajaxListServices'])->name('services.ajaxListServices');
        Route::get('/services/{service}/edit', [AdminController::class, 'editService'])->name('services.admin.edit');
        Route::put('/services/{service}/update', [AdminController::class, 'updateService'])->name('services.admin.update');
        Route::delete('services/{service}/delete', [AdminController::class, 'destroyService'])->name('services.destroy');
        Route::post('/services/create', [AdminController::class, 'createService'])->name('services.create');
        Route::post('/type_services/create', [AdminController::class, 'createTypeService'])->name('type_services.create');


    });

    Route::middleware(['can:have_permissions'])->group(function () {
        Route::get('/properties/manage', [AsesorController::class, 'list_properties'])->name('properties.manage');
    });
    
   


    
    // Añade aquí otras rutas de administración.