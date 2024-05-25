<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\SuperAdmin\SuperAdminScheduleController;


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


Route::middleware('admin')->prefix('admin')->group(function() {
  Route::get('/schedule', [AdminScheduleController::class, 'index'])->name('admin.schedule.index');
  Route::get('/schedule/list', [AdminScheduleController::class, 'listSchedule'])->name('admin.schedule.list');
  Route::get('/schedule/create', [AdminScheduleController::class, 'create'])->name('admin.schedule.create');
  Route::post('/schedule/store', [AdminScheduleController::class, 'store'])->name('admin.schedule.store');
  Route::get('/schedule/{schedule}/edit', [AdminScheduleController::class, 'edit'])->name('admin.schedule.edit');
  Route::put('/schedule/{schedule}/update', [AdminScheduleController::class, 'update'])->name('admin.schedule.update');
  Route::delete('/schedule/{schedule}/destroy', [AdminScheduleController::class, 'destroy'])->name('admin.schedule.destroy');

  Route::get('/shift', 'App\Http\Controllers\Admin\AdminShiftController@index')->name("admin.shift.index");
  Route::get('/shift/create', 'App\Http\Controllers\Admin\AdminShiftController@create')->name("admin.shift.create");
  Route::get('/shift/{id}/edit', 'App\Http\Controllers\Admin\AdminShiftController@edit')->name("admin.shift.edit");
  Route::put('/shift/{id}/update', 'App\Http\Controllers\Admin\AdminShiftController@update')->name("admin.shift.update");
  Route::post('/shift/store', 'App\Http\Controllers\Admin\AdminShiftController@store')->name("admin.shift.store");
  Route::delete('/shift/{id}/delete', 'App\Http\Controllers\Admin\AdminShiftController@delete')->name("admin.shift.delete");

  Route::get('/operator', 'App\Http\Controllers\Admin\AdminOperatorController@index')->name("admin.operator.index");
  Route::get('/operator/create', 'App\Http\Controllers\Admin\AdminOperatorController@create')->name("admin.operator.create");
  Route::post('/operator/store', 'App\Http\Controllers\Admin\AdminOperatorController@store')->name("admin.operator.store");
  Route::get('/operator/{id}/edit', 'App\Http\Controllers\Admin\AdminOperatorController@edit')->name("admin.operator.edit");
  Route::put('/operator/{id}/update', 'App\Http\Controllers\Admin\AdminOperatorController@update')->name("admin.operator.update");
  Route::delete('/operator/{id}/delete', 'App\Http\Controllers\Admin\AdminOperatorController@delete')->name("admin.operator.delete");

  Route::get('/supervisor', 'App\Http\Controllers\Admin\AdminSupervisorController@index')->name("admin.supervisor.index");
  Route::get('/supervisor/create', 'App\Http\Controllers\Admin\AdminSupervisorController@create')->name("admin.supervisor.create");
  Route::post('/supervisor/store', 'App\Http\Controllers\Admin\AdminSupervisorController@store')->name("admin.supervisor.store");
  Route::get('/supervisor/{id}/edit', 'App\Http\Controllers\Admin\AdminSupervisorController@edit')->name("admin.supervisor.edit");
  Route::put('/supervisor/{id}/update', 'App\Http\Controllers\Admin\AdminSupervisorController@update')->name("admin.supervisor.update");
  Route::delete('/supervisor/{id}/delete', 'App\Http\Controllers\Admin\AdminSupervisorController@delete')->name("admin.supervisor.delete");

  Route::get('/department', 'App\Http\Controllers\Admin\AdminDepartmentController@index')->name("admin.department.index");
  Route::get('/department/create', 'App\Http\Controllers\Admin\AdminDepartmentController@create')->name("admin.department.create");
  Route::get('/department/{id}/edit', 'App\Http\Controllers\Admin\AdminDepartmentController@edit')->name("admin.department.edit");
  Route::put('/department/{id}/update', 'App\Http\Controllers\Admin\AdminDepartmentController@update')->name("admin.department.update");
  Route::post('/department/store', 'App\Http\Controllers\Admin\AdminDepartmentController@store')->name("admin.department.store");
  Route::delete('/department/{id}/delete', 'App\Http\Controllers\Admin\AdminDepartmentController@delete')->name("admin.department.delete");

  Route::get('/operator_type', 'App\Http\Controllers\Admin\AdminOperatorTypeController@index')->name("admin.operator_type.index");
  Route::get('/operator_type/create', 'App\Http\Controllers\Admin\AdminOperatorTypeController@create')->name("admin.operator_type.create");
  Route::get('/operator_type/{id}/edit', 'App\Http\Controllers\Admin\AdminOperatorTypeController@edit')->name("admin.operator_type.edit");
  Route::put('/operator_type/{id}/update', 'App\Http\Controllers\Admin\AdminOperatorTypeController@update')->name("admin.operator_type.update");
  Route::post('/operator_type/store', 'App\Http\Controllers\Admin\AdminOperatorTypeController@store')->name("admin.operator_type.store");
  Route::delete('/operator_type/{id}/delete', 'App\Http\Controllers\Admin\AdminOperatorTypeController@delete')->name("admin.operator_type.delete");

  Route::get('/company', 'App\Http\Controllers\Admin\AdminCompanyController@index')->name("admin.company.index");
  Route::get('/company/{id}/edit', 'App\Http\Controllers\Admin\AdminCompanyController@edit')->name("admin.company.edit");
  Route::put('/company/{id}/update', 'App\Http\Controllers\Admin\AdminCompanyController@update')->name("admin.company.update");
  Route::delete('/company/{id}/delete', 'App\Http\Controllers\Admin\AdminCompanyController@delete')->name("admin.company.delete");
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");
Route::get('/error', 'App\Http\Controllers\HomeController@error')->name("home.error");

Route::middleware('superadmin')->prefix('superadmin')->group(function() {
  Route::get('/schedule', [SuperAdminScheduleController::class, 'index'])->name('superadmin.schedule.index');
  Route::get('/schedule/list', [SuperAdminScheduleController::class, 'listSchedule'])->name('superadmin.schedule.list');
  Route::get('/schedule/create', [SuperAdminScheduleController::class, 'create'])->name('superadmin.schedule.create');
  Route::post('/schedule/store', [SuperAdminScheduleController::class, 'store'])->name('superadmin.schedule.store');
  Route::get('/schedule/{schedule}/edit', [SuperAdminScheduleController::class, 'edit'])->name('superadmin.schedule.edit');
  Route::put('/schedule/{schedule}/update', [SuperAdminScheduleController::class, 'update'])->name('superadmin.schedule.update');
  Route::delete('/schedule/{schedule}/destroy', [SuperAdminScheduleController::class, 'destroy'])->name('superadmin.schedule.destroy');
  Route::get('/shift', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@index')->name("superadmin.shift.index");
  Route::get('/shift/create', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@create')->name("superadmin.shift.create");
  Route::get('/shift/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@edit')->name("superadmin.shift.edit");
  Route::put('/shift/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@update')->name("superadmin.shift.update");
  Route::post('/shift/store', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@store')->name("superadmin.shift.store");
  Route::delete('/shift/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@delete')->name("superadmin.shift.delete");

  Route::get('/operator', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@index')->name("superadmin.operator.index");
  Route::get('/operator/create', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@create')->name("superadmin.operator.create");
  Route::post('/operator/store', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@store')->name("superadmin.operator.store");
  Route::get('/operator/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@edit')->name("superadmin.operator.edit");
  Route::put('/operator/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@update')->name("superadmin.operator.update");
  Route::delete('/operator/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@delete')->name("superadmin.operator.delete");

  Route::get('/supervisor', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@index')->name("superadmin.supervisor.index");
  Route::get('/supervisor/create', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@create')->name("superadmin.supervisor.create");
  Route::post('/supervisor/store', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@store')->name("superadmin.supervisor.store");
  Route::get('/supervisor/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@edit')->name("superadmin.supervisor.edit");
  Route::put('/supervisor/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@update')->name("superadmin.supervisor.update");
  Route::delete('/supervisor/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@delete')->name("superadmin.supervisor.delete");

  Route::get('/operator_type', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@index')->name("superadmin.operator_type.index");
  Route::get('/operator_type/create', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@create')->name("superadmin.operator_type.create");
  Route::get('/operator_type/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@edit')->name("superadmin.operator_type.edit");
  Route::put('/operator_type/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@update')->name("superadmin.operator_type.update");
  Route::post('/operator_type/store', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@store')->name("superadmin.operator_type.store");
  Route::delete('/operator_type/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorTypeController@delete')->name("superadmin.operator_type.delete");

  Route::get('/department', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@index')->name("superadmin.department.index");
  Route::get('/department/create', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@create')->name("superadmin.department.create");
  Route::get('/department/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@edit')->name("superadmin.department.edit");
  Route::put('/department/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@update')->name("superadmin.department.update");
  Route::post('/department/store', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@store')->name("superadmin.department.store");
  Route::delete('/department/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@delete')->name("superadmin.department.delete");

  Route::get('/company', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@index')->name("superadmin.company.index");
  Route::get('/company/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@edit')->name("superadmin.company.edit");
  Route::put('/company/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@update')->name("superadmin.company.update");
  Route::delete('/company/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@delete')->name("superadmin.company.delete");
});


Auth::routes(['verify' => true]);