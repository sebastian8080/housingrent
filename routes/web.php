<?php

use App\Http\Controllers\SearchController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/propiedades/{slug}', [WebController::class, 'show'])->name('show.property');
Route::get('/publique-con-nosotros', [WebController::class, 'uploadpage'])->name('show.upload.page');
Route::get('/contactenos', [WebController::class, 'contact'])->name('web.contact');
Route::post('/send-lead', [WebController::class, 'sendlead'])->name('web.send.lead');
Route::get('/thank', function(){ return view('web.thank');})->name('web.thank');

Route::get('/search', [SearchController::class, 'search'])->name('web.search');
Route::get('/{type}/{location?}', [SearchController::class, 'redirectBySearch'])->name('web.redirect.search');