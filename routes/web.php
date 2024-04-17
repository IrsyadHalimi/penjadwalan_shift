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

Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/admin/jadwal', 'App\Http\Controllers\Admin\AdminJadwalController@index')->name("admin.jadwal.index");
Route::post('/admin/jadwal/store', 'App\Http\Controllers\Admin\AdminJadwalController@store')->name("admin.jadwal.store");
Route::get('/admin/jadwal/{id_jadwal}/edit', 'App\Http\Controllers\Admin\AdminJadwalController@edit')->name("admin.jadwal.edit");
Route::put('/admin/jadwal/{id_jadwal}/update', 'App\Http\Controllers\Admin\AdminJadwalController@update')->name("admin.jadwal.update");
Route::get('/admin/shift', 'App\Http\Controllers\Admin\AdminShiftController@index')->name("admin.shift.index");
Route::get('/admin/shift/{id_shift}/edit', 'App\Http\Controllers\Admin\AdminShiftController@edit')->name("admin.shift.edit");
Route::put('/admin/shift/{id_shift}/update', 'App\Http\Controllers\Admin\AdminShiftController@update')->name("admin.shift.update");