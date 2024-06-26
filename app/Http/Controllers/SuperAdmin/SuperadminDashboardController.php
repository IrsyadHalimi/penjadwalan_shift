<?php

namespace App\Http\Controllers\Superadmin;
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


class SuperadminDashboardController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Dasbor - Penjadwalan Shift";
    $viewData["subtitle"] = "Dasbor Superadmin";
    
    $viewData["company"] = Company::count();
    $viewData["department"] = Department::count();
    $viewData["operator"] = User::where('role', 'operator')->count();
    $viewData["company_admin"] = User::where('role', 'admin')->count();
    $viewData["supervisor"] = User::where('role', 'supervisor')->count();
    $viewData["shift"] = Shift::count();
    $viewData["operator_type"] = OperatorType::count();
    $viewData["schedule"] = Schedule::count();
    
    return view('superadmin.dashboard.index')->with("viewData", $viewData);
  }
}