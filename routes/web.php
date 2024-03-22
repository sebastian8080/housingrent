<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [WebController::class, 'home'])->name('web.home');
Route::get('/propiedades/{slug}', [WebController::class, 'show'])->name('show.property');
Route::get('/publique-con-nosotros', [WebController::class, 'uploadpage'])->name('show.upload.page');
Route::get('/contactenos', [WebController::class, 'contact'])->name('web.contact');
Route::post('/send-lead', [WebController::class, 'sendlead'])->name('web.send.lead');
Route::get('/thank', function(){ return view('web.thank');})->name('web.thank');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
