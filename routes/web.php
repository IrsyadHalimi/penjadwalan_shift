<?php

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

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/admin', 'App\Http\Controllers\Admin\AdminHomeController@index')->name("admin.home.index");
Route::get('/admin/jadwal', 'App\Http\Controllers\Admin\AdminJadwalController@index')->name("admin.jadwal.index");
Route::get('/admin/jadwal/store', 'App\Http\Controllers\Admin\AdminJadwalController@store')->name("admin.jadwal.store");


// Route::middleware('admin')->group(function() {
//   Route::get('/admin', [AdminJadwalController::class, 'index'])->name("admin.home.index");
// });