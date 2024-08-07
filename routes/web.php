<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\Admin\AdminScheduleController;
use App\Http\Controllers\Superadmin\SuperadminScheduleController;
use App\Http\Controllers\Supervisor\SupervisorScheduleController;
use App\Http\Controllers\Operator\OperatorScheduleController;
use App\Http\Livewire\SelectDropdowns;


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
  Route::get('/dashboard', 'App\Http\Controllers\Admin\AdminDashboardController@index')->name('admin.dashboard.index');

  Route::get('/schedule', 'App\Http\Controllers\Admin\AdminScheduleController@index')->name('admin.schedule.index');
  Route::get('/schedule/create', 'App\Http\Controllers\Admin\AdminScheduleController@create')->name('admin.schedule.create');
  Route::post('/schedule/store', 'App\Http\Controllers\Admin\AdminScheduleController@store')->name('admin.schedule.store');
  Route::get('/schedule/{id}/edit', 'App\Http\Controllers\Admin\AdminScheduleController@edit')->name('admin.schedule.edit');
  Route::put('/schedule/{id}/update', 'App\Http\Controllers\Admin\AdminScheduleController@update')->name('admin.schedule.update');
  Route::delete('/schedule/{id}/delete', 'App\Http\Controllers\Admin\AdminScheduleController@delete')->name('admin.schedule.delete');

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
  
  Route::get('/profile', 'App\Http\Controllers\Admin\AdminProfileController@index')->name("admin.profile.index");
  Route::get('/profile/{id}/edit', 'App\Http\Controllers\Admin\AdminProfileController@edit')->name("admin.profile.edit");
  Route::put('/profile/{id}/update', 'App\Http\Controllers\Admin\AdminProfileController@update')->name("admin.profile.update");
  
  Route::get('/report', 'App\Http\Controllers\Admin\AdminReportController@index')->name("admin.report.index");
  Route::get('/report/generateAllSchedulePdf', 'App\Http\Controllers\Admin\AdminReportController@generateAllSchedulePdf')->name("admin.report.generateAllSchedulePdf");
  Route::post('/report/generatePdf', 'App\Http\Controllers\Admin\AdminReportController@generatePdf')->name("admin.report.generatePdf");
  Route::post('/report/generateOperatorPdf', 'App\Http\Controllers\Admin\AdminReportController@generateOperatorPdf')->name("admin.report.generateOperatorPdf");
  Route::post('/report/generateByMonth', 'App\Http\Controllers\Admin\AdminReportController@generateByMonth')->name("admin.report.generateByMonth");
});

Route::get('/', 'App\Http\Controllers\HomeController@index')->name("home.index");

Route::middleware('superadmin')->prefix('superadmin')->group(function() {
  Route::get('/dashboard', 'App\Http\Controllers\Superadmin\SuperadminDashboardController@index')->name('superadmin.dashboard.index');
  
  Route::get('/schedule', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@index')->name('superadmin.schedule.index');
  Route::get('/schedule/create', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@create')->name('superadmin.schedule.create');
  Route::post('/schedule/store', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@store')->name('superadmin.schedule.store');
  Route::get('/schedule/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@edit')->name('superadmin.schedule.edit');
  Route::put('/schedule/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@update')->name('superadmin.schedule.update');
  Route::delete('/schedule/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminScheduleController@delete')->name('superadmin.schedule.delete');
  
  Route::get('/shift', 'App\Http\Controllers\Superadmin\SuperadminShiftController@index')->name("superadmin.shift.index");
  Route::get('/shift/create', 'App\Http\Controllers\Superadmin\SuperadminShiftController@create')->name("superadmin.shift.create");
  Route::get('/shift/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminShiftController@edit')->name("superadmin.shift.edit");
  Route::put('/shift/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminShiftController@update')->name("superadmin.shift.update");
  Route::post('/shift/store', 'App\Http\Controllers\Superadmin\SuperadminShiftController@store')->name("superadmin.shift.store");
  Route::delete('/shift/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminShiftController@delete')->name("superadmin.shift.delete");

  Route::get('/operator', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@index')->name("superadmin.operator.index");
  Route::get('/operator/create', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@create')->name("superadmin.operator.create");
  Route::post('/operator/store', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@store')->name("superadmin.operator.store");
  Route::get('/operator/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@edit')->name("superadmin.operator.edit");
  Route::put('/operator/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@update')->name("superadmin.operator.update");
  Route::delete('/operator/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminOperatorController@delete')->name("superadmin.operator.delete");
  
  Route::get('/company_admin', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@index')->name("superadmin.company_admin.index");
  Route::get('/company_admin/create', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@create')->name("superadmin.company_admin.create");
  Route::post('/company_admin/store', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@store')->name("superadmin.company_admin.store");
  Route::get('/company_admin/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@edit')->name("superadmin.company_admin.edit");
  Route::put('/company_admin/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@update')->name("superadmin.company_admin.update");
  Route::delete('/company_admin/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminCompanyAdminController@delete')->name("superadmin.company_admin.delete");

  Route::get('/supervisor', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@index')->name("superadmin.supervisor.index");
  Route::get('/supervisor/create', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@create')->name("superadmin.supervisor.create");
  Route::post('/supervisor/store', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@store')->name("superadmin.supervisor.store");
  Route::get('/supervisor/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@edit')->name("superadmin.supervisor.edit");
  Route::put('/supervisor/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@update')->name("superadmin.supervisor.update");
  Route::delete('/supervisor/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminSupervisorController@delete')->name("superadmin.supervisor.delete");

  Route::get('/operator_type', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@index')->name("superadmin.operator_type.index");
  Route::get('/operator_type/create', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@create')->name("superadmin.operator_type.create");
  Route::get('/operator_type/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@edit')->name("superadmin.operator_type.edit");
  Route::put('/operator_type/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@update')->name("superadmin.operator_type.update");
  Route::post('/operator_type/store', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@store')->name("superadmin.operator_type.store");
  Route::delete('/operator_type/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminOperatorTypeController@delete')->name("superadmin.operator_type.delete");

  Route::get('/department', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@index')->name("superadmin.department.index");
  Route::get('/department/create', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@create')->name("superadmin.department.create");
  Route::get('/department/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@edit')->name("superadmin.department.edit");
  Route::put('/department/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@update')->name("superadmin.department.update");
  Route::post('/department/store', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@store')->name("superadmin.department.store");
  Route::delete('/department/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminDepartmentController@delete')->name("superadmin.department.delete");

  Route::get('/company', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@index')->name("superadmin.company.index");
  Route::get('/company/create', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@create')->name("superadmin.company.create");
  Route::post('/company/store', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@store')->name("superadmin.company.store");
  Route::get('/company/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@edit')->name("superadmin.company.edit");
  Route::put('/company/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@update')->name("superadmin.company.update");
  Route::delete('/company/{id}/delete', 'App\Http\Controllers\Superadmin\SuperadminCompanyController@delete')->name("superadmin.company.delete");

  Route::get('/profile', 'App\Http\Controllers\Superadmin\SuperadminProfileController@index')->name("superadmin.profile.index");
  Route::get('/profile/{id}/edit', 'App\Http\Controllers\Superadmin\SuperadminProfileController@edit')->name("superadmin.profile.edit");
  Route::put('/profile/{id}/update', 'App\Http\Controllers\Superadmin\SuperadminProfileController@update')->name("superadmin.profile.update");

  Route::get('/report', 'App\Http\Controllers\Superadmin\SuperadminReportController@index')->name("superadmin.report.index");
  Route::get('/report/generateAllSchedulePdf', 'App\Http\Controllers\Superadmin\SuperadminReportController@generateAllSchedulePdf')->name("superadmin.report.generateAllSchedulePdf");
  Route::post('/report/generatePdf', 'App\Http\Controllers\Superadmin\SuperadminReportController@generatePdf')->name("superadmin.report.generatePdf");
  Route::post('/report/generateOperatorPdf', 'App\Http\Controllers\Superadmin\SuperadminReportController@generateOperatorPdf')->name("superadmin.report.generateOperatorPdf");
});

Route::middleware('supervisor')->prefix('supervisor')->group(function() {
  Route::get('/dashboard', 'App\Http\Controllers\Supervisor\SupervisorDashboardController@index')->name('supervisor.dashboard.index');
  
  Route::get('/schedule', [SupervisorScheduleController::class, 'index'])->name('supervisor.schedule.index');
  Route::get('/schedule/list', [SupervisorScheduleController::class, 'listSchedule'])->name('supervisor.schedule.list');
  Route::get('/schedule/create', [SupervisorScheduleController::class, 'create'])->name('supervisor.schedule.create');
  Route::post('/schedule/store', [SupervisorScheduleController::class, 'store'])->name('supervisor.schedule.store');
  Route::get('/schedule/{schedule}/edit', [SupervisorScheduleController::class, 'edit'])->name('supervisor.schedule.edit');
  Route::put('/schedule/{schedule}/update', [SupervisorScheduleController::class, 'update'])->name('supervisor.schedule.update');
  Route::delete('/schedule/{schedule}/destroy', [SupervisorScheduleController::class, 'destroy'])->name('supervisor.schedule.destroy');
  
  Route::get('/profile', 'App\Http\Controllers\Supervisor\SupervisorProfileController@index')->name("supervisor.profile.index");
  Route::get('/profile/{id}/edit', 'App\Http\Controllers\Supervisor\SupervisorProfileController@edit')->name("supervisor.profile.edit");
  Route::put('/profile/{id}/update', 'App\Http\Controllers\Supervisor\SupervisorProfileController@update')->name("supervisor.profile.update");

  Route::get('/report', 'App\Http\Controllers\Supervisor\SupervisorReportController@index')->name("supervisor.report.index");
  Route::get('/report/generateAllSchedulePdf', 'App\Http\Controllers\Supervisor\SupervisorReportController@generateAllSchedulePdf')->name("supervisor.report.generateAllSchedulePdf");
  Route::post('/report/generatePdf', 'App\Http\Controllers\Supervisor\SupervisorReportController@generatePdf')->name("supervisor.report.generatePdf");
  Route::post('/report/generateOperatorPdf', 'App\Http\Controllers\Supervisor\SupervisorReportController@generateOperatorPdf')->name("supervisor.report.generateOperatorPdf");
  
  Route::get('/operator', 'App\Http\Controllers\Supervisor\SupervisorOperatorController@index')->name("supervisor.operator.index");
});

Route::middleware('operator')->prefix('operator')->group(function() {
  Route::get('/schedule', [OperatorScheduleController::class, 'index'])->name('operator.schedule.index');
  Route::get('/schedule/list', [OperatorScheduleController::class, 'listSchedule'])->name('operator.schedule.list');
  Route::get('/schedule/create', [OperatorScheduleController::class, 'create'])->name('operator.schedule.create');
  Route::post('/schedule/store', [OperatorScheduleController::class, 'store'])->name('operator.schedule.store');
  Route::get('/schedule/{schedule}/edit', [OperatorScheduleController::class, 'edit'])->name('operator.schedule.edit');
  Route::put('/schedule/{schedule}/update', [OperatorScheduleController::class, 'update'])->name('operator.schedule.update');
  Route::delete('/schedule/{schedule}/destroy', [OperatorScheduleController::class, 'destroy'])->name('operator.schedule.destroy');
  Route::post('/schedule/generatePdf', 'App\Http\Controllers\Operator\OperatorScheduleController@generatePdf')->name("operator.schedule.generatePdf");

  Route::get('/profile', 'App\Http\Controllers\Operator\OperatorProfileController@index')->name("operator.profile.index");
  Route::get('/profile/{id}/edit', 'App\Http\Controllers\Operator\OperatorProfileController@edit')->name("operator.profile.edit");
  Route::put('/profile/{id}/update', 'App\Http\Controllers\Operator\OperatorProfileController@update')->name("operator.profile.update");
  
  Route::get('/supervisor', 'App\Http\Controllers\Operator\OperatorSupervisorController@index')->name("operator.supervisor.index");
});


Auth::routes(['verify' => true]);