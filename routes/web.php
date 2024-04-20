<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;

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
Route::get('/admin/shift/create', 'App\Http\Controllers\Admin\AdminShiftController@create')->name("admin.shift.create");
Route::get('/admin/shift/{id_shift}/edit', 'App\Http\Controllers\Admin\AdminShiftController@edit')->name("admin.shift.edit");
Route::put('/admin/shift/{id_shift}/update', 'App\Http\Controllers\Admin\AdminShiftController@update')->name("admin.shift.update");
Route::post('/admin/shift/store', 'App\Http\Controllers\Admin\AdminShiftController@store')->name("admin.shift.store");
Route::delete('/admin/shift/{id_shift}/delete', 'App\Http\Controllers\Admin\AdminShiftController@delete')->name("admin.shift.delete");
Route::get('/admin/operator', 'App\Http\Controllers\Admin\AdminOperatorController@index')->name("admin.operator.index");
Route::get('/admin/operator/{id_user}/edit', 'App\Http\Controllers\Admin\AdminOperatorController@edit')->name("admin.operator.edit");
Route::put('/admin/operator/{id_user}/update', 'App\Http\Controllers\Admin\AdminOperatorController@update')->name("admin.operator.update");
Route::delete('/admin/operator/{id_user}/delete', 'App\Http\Controllers\Admin\AdminOperatorController@delete')->name("admin.operator.delete");
Route::get('/admin/supervisor', 'App\Http\Controllers\Admin\AdminSupervisorController@index')->name("admin.supervisor.index");
Route::get('/admin/supervisor/{id_user}/edit', 'App\Http\Controllers\Admin\AdminSupervisorController@edit')->name("admin.supervisor.edit");
Route::put('/admin/supervisor/{id_user}/update', 'App\Http\Controllers\Admin\AdminSupervisorController@update')->name("admin.supervisor.update");
Route::delete('/admin/supervisor/{id_user}/delete', 'App\Http\Controllers\Admin\AdminSupervisorController@delete')->name("admin.supervisor.delete");
Route::get('/admin/departemen', 'App\Http\Controllers\Admin\AdminDepartemenController@index')->name("admin.departemen.index");
Route::get('/admin/departemen/create', 'App\Http\Controllers\Admin\AdminDepartemenController@create')->name("admin.departemen.create");
Route::get('/admin/departemen/{id_departemen}/edit', 'App\Http\Controllers\Admin\AdminDepartemenController@edit')->name("admin.departemen.edit");
Route::put('/admin/departemen/{id_departemen}/update', 'App\Http\Controllers\Admin\AdminDepartemenController@update')->name("admin.departemen.update");
Route::post('/admin/departemen/store', 'App\Http\Controllers\Admin\AdminDepartemenController@store')->name("admin.departemen.store");
Route::delete('/admin/departemen/{id_departemen}/delete', 'App\Http\Controllers\Admin\AdminDepartemenController@delete')->name("admin.departemen.delete");
Route::controller(FullCalenderController::class)->group(function(){
  Route::get('fullcalender', 'index');
  Route::post('fullcalenderAjax', 'ajax');
});