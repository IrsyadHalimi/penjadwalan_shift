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
Route::get('/admin/supervisor/create', 'App\Http\Controllers\Admin\AdminSupervisorController@create')->name("admin.supervisor.create");
Route::post('/admin/supervisor/store', 'App\Http\Controllers\Admin\AdminSupervisorController@store')->name("admin.supervisor.store");
Route::get('/admin/supervisor/{id}/edit', 'App\Http\Controllers\Admin\AdminSupervisorController@edit')->name("admin.supervisor.edit");
Route::put('/admin/supervisor/{id}/update', 'App\Http\Controllers\Admin\AdminSupervisorController@update')->name("admin.supervisor.update");
Route::delete('/admin/supervisor/{id}/delete', 'App\Http\Controllers\Admin\AdminSupervisorController@delete')->name("admin.supervisor.delete");

Route::get('/admin/department', 'App\Http\Controllers\Admin\AdminDepartmentController@index')->name("admin.department.index");
Route::get('/admin/department/create', 'App\Http\Controllers\Admin\AdminDepartmentController@create')->name("admin.department.create");
Route::get('/admin/department/{id}/edit', 'App\Http\Controllers\Admin\AdminDepartmentController@edit')->name("admin.department.edit");
Route::put('/admin/department/{id}/update', 'App\Http\Controllers\Admin\AdminDepartmentController@update')->name("admin.department.update");
Route::post('/admin/department/store', 'App\Http\Controllers\Admin\AdminDepartmentController@store')->name("admin.department.store");
Route::delete('/admin/department/{id}/delete', 'App\Http\Controllers\Admin\AdminDepartmentController@delete')->name("admin.department.delete");

Route::get('/admin/operator_type', 'App\Http\Controllers\Admin\AdminOperatorTypeController@index')->name("admin.operator_type.index");
Route::get('/admin/operator_type/create', 'App\Http\Controllers\Admin\AdminOperatorTypeController@create')->name("admin.operator_type.create");
Route::get('/admin/operator_type/{id}/edit', 'App\Http\Controllers\Admin\AdminOperatorTypeController@edit')->name("admin.operator_type.edit");
Route::put('/admin/operator_type/{id}/update', 'App\Http\Controllers\Admin\AdminOperatorTypeController@update')->name("admin.operator_type.update");
Route::post('/admin/operator_type/store', 'App\Http\Controllers\Admin\AdminOperatorTypeController@store')->name("admin.operator_type.store");
Route::delete('/admin/operator_type/{id}/delete', 'App\Http\Controllers\Admin\AdminOperatorTypeController@delete')->name("admin.operator_type.delete");

Route::get('/admin/company', 'App\Http\Controllers\Admin\AdminCompanyController@index')->name("admin.company.index");
Route::get('/admin/company/{id}/edit', 'App\Http\Controllers\Admin\AdminCompanyController@edit')->name("admin.company.edit");
Route::put('/admin/company/{id}/update', 'App\Http\Controllers\Admin\AdminCompanyController@update')->name("admin.company.update");
Route::delete('/admin/company/{id}/delete', 'App\Http\Controllers\Admin\AdminCompanyController@delete')->name("admin.company.delete");

Route::get('schedule/list', [AdminScheduleController::class, 'listSchedule'])->name('schedule.list');
Route::resource('schedule', AdminScheduleController::class);
Route::get('/superadmin/schedule', 'App\Http\Controllers\Admin\AdminScheduleController@index')->name("admin.schedule.index");

Route::get('/superadmin/shift', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@index')->name("superadmin.shift.index");
Route::get('/superadmin/shift/create', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@create')->name("superadmin.shift.create");
Route::get('/superadmin/shift/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@edit')->name("superadmin.shift.edit");
Route::put('/superadmin/shift/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@update')->name("superadmin.shift.update");
Route::post('/superadmin/shift/store', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@store')->name("superadmin.shift.store");
Route::delete('/superadmin/shift/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminShiftController@delete')->name("superadmin.shift.delete");

Route::get('/superadmin/operator', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@index')->name("superadmin.operator.index");
Route::get('/superadmin/operator/create', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@create')->name("superadmin.operator.create");
Route::post('/superadmin/operator/store', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@store')->name("superadmin.operator.store");
Route::get('/superadmin/operator/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@edit')->name("superadmin.operator.edit");
Route::put('/superadmin/operator/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@update')->name("superadmin.operator.update");
Route::delete('/superadmin/operator/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminOperatorController@delete')->name("superadmin.operator.delete");

Route::get('/superadmin/supervisor', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@index')->name("superadmin.supervisor.index");
Route::get('/superadmin/supervisor/create', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@create')->name("superadmin.supervisor.create");
Route::post('/superadmin/supervisor/store', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@store')->name("superadmin.supervisor.store");
Route::get('/superadmin/supervisor/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@edit')->name("superadmin.supervisor.edit");
Route::put('/superadmin/supervisor/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@update')->name("superadmin.supervisor.update");
Route::delete('/superadmin/supervisor/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminSupervisorController@delete')->name("superadmin.supervisor.delete");

Route::get('/superadmin/department', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@index')->name("superadmin.department.index");
Route::get('/superadmin/department/create', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@create')->name("superadmin.department.create");
Route::get('/superadmin/department/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@edit')->name("superadmin.department.edit");
Route::put('/superadmin/department/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@update')->name("superadmin.department.update");
Route::post('/superadmin/department/store', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@store')->name("superadmin.department.store");
Route::delete('/superadmin/department/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminDepartmentController@delete')->name("superadmin.department.delete");

Route::get('/superadmin/company', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@index')->name("superadmin.company.index");
Route::get('/superadmin/company/{id}/edit', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@edit')->name("superadmin.company.edit");
Route::put('/superadmin/company/{id}/update', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@update')->name("superadmin.company.update");
Route::delete('/superadmin/company/{id}/delete', 'App\Http\Controllers\SuperAdmin\SuperAdminCompanyController@delete')->name("superadmin.company.delete");
