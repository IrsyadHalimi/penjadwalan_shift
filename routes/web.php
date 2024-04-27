<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\AdminScheduleController;

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
Route::get('schedule/list', [AdminScheduleController::class, 'listSchedule'])->name('schedule.list');
Route::resource('schedule', AdminScheduleController::class);
Route::get('/admin/schedule', 'App\Http\Controllers\Admin\AdminScheduleController@index')->name("admin.schedule.index");
Route::get('/admin/shift', 'App\Http\Controllers\Admin\AdminShiftController@index')->name("admin.shift.index");
Route::get('/admin/shift/create', 'App\Http\Controllers\Admin\AdminShiftController@create')->name("admin.shift.create");
Route::get('/admin/shift/{id}/edit', 'App\Http\Controllers\Admin\AdminShiftController@edit')->name("admin.shift.edit");
Route::put('/admin/shift/{id}/update', 'App\Http\Controllers\Admin\AdminShiftController@update')->name("admin.shift.update");
Route::post('/admin/shift/store', 'App\Http\Controllers\Admin\AdminShiftController@store')->name("admin.shift.store");
Route::delete('/admin/shift/{id}/delete', 'App\Http\Controllers\Admin\AdminShiftController@delete')->name("admin.shift.delete");
Route::get('/admin/operator', 'App\Http\Controllers\Admin\AdminOperatorController@index')->name("admin.operator.index");
Route::get('/admin/operator/create', 'App\Http\Controllers\Admin\AdminOperatorController@create')->name("admin.operator.create");
Route::post('/admin/operator/store', 'App\Http\Controllers\Admin\AdminOperatorController@store')->name("admin.operator.store");
Route::get('/admin/operator/{id}/edit', 'App\Http\Controllers\Admin\AdminOperatorController@edit')->name("admin.operator.edit");
Route::put('/admin/operator/{id}/update', 'App\Http\Controllers\Admin\AdminOperatorController@update')->name("admin.operator.update");
Route::delete('/admin/operator/{id}/delete', 'App\Http\Controllers\Admin\AdminOperatorController@delete')->name("admin.operator.delete");
Route::get('/admin/supervisor', 'App\Http\Controllers\Admin\AdminSupervisorController@index')->name("admin.supervisor.index");
Route::get('/admin/supervisor/{id_user}/edit', 'App\Http\Controllers\Admin\AdminSupervisorController@edit')->name("admin.supervisor.edit");
Route::put('/admin/supervisor/{id_user}/update', 'App\Http\Controllers\Admin\AdminSupervisorController@update')->name("admin.supervisor.update");
Route::delete('/admin/supervisor/{id_user}/delete', 'App\Http\Controllers\Admin\AdminSupervisorController@delete')->name("admin.supervisor.delete");
Route::get('/admin/department', 'App\Http\Controllers\Admin\AdminDepartmentController@index')->name("admin.department.index");
Route::get('/admin/department/create', 'App\Http\Controllers\Admin\AdminDepartmentController@create')->name("admin.department.create");
Route::get('/admin/department/{id}/edit', 'App\Http\Controllers\Admin\AdminDepartmentController@edit')->name("admin.department.edit");
Route::put('/admin/department/{id}/update', 'App\Http\Controllers\Admin\AdminDepartmentController@update')->name("admin.department.update");
Route::post('/admin/department/store', 'App\Http\Controllers\Admin\AdminDepartmentController@store')->name("admin.department.store");
Route::delete('/admin/department/{id}/delete', 'App\Http\Controllers\Admin\AdminDepartmentController@delete')->name("admin.department.delete");
