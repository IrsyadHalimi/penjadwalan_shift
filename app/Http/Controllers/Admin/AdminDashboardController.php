<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Schedule;
use App\Models\Department;
use App\Models\Shift;
use App\Models\User;
use App\Models\OperatorType;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminDashboardController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();
    $userId = User::where('company_id', $companyId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Dasbor - Penjadwalan Shift";
    $viewData["subtitle"] = "Dasbor Admin";
    
    $viewData["company"] = Company::where('id', $companyId)->get();
    $viewData["department"] = Department::where('company_id', $companyId)->get();
    $viewData["operator"] = User::where('role', 'operator')->where('company_id', $companyId)->count();
    $viewData["supervisor"] = User::where('role', 'supervisor')->where('company_id', $companyId)->count();
    $viewData["shift"] = Shift::whereIn('department_id', $departmentId)->count();
    $viewData["operator_type"] = Company::where('id', $companyId)->get();
    $viewData["schedule"] = Schedule::whereIn('user_id', $userId)->count();
    
    return view('admin.dashboard.index')->with("viewData", $viewData);
  }
}