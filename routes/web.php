<?php

use App\Http\Controllers\Login_Controller;
use App\Http\Controllers\Dashboard_Controller;
use App\Http\Controllers\Destinations_Controller;
use App\Http\Controllers\Gallery_Controller;
use App\Http\Controllers\Pengunjung_Controller;
use App\Http\Controllers\User_Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [Login_Controller::class, 'index']);
Route::post('/login', [Login_Controller::class, 'authenticate']);

Route::get('/dashboard', [Dashboard_Controller::class,'index']);

Route::resource('user', User_Controller::class);
Route::get('pengunjung/cetak',[Pengunjung_Controller::class,'cetak'])->name('pengunjung.cetak');
Route::resource('pengunjung', Pengunjung_Controller::class);

Route::get('destinasi/cetak',[Destinations_Controller::class,'cetak'])->name('destinasi.cetak');
Route::resource('destinasi', Destinations_Controller::class);

Route::get('gallery/cetak',[Gallery_Controller::class,'cetak'])->name('gallery.cetak');
Route::delete('gallery/destroygallery/',[Gallery_Controller::class,'destroygallery'])->name('gallery.destroygallery');
Route::resource('gallery', Gallery_Controller::class);








