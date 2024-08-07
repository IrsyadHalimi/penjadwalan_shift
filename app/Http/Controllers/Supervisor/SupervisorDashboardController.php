<?php

namespace App\Http\Controllers\Supervisor;
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


class SupervisorDashboardController extends Controller
{
  public function index()
  {
    $departmentId = Auth::user()->department_id;
    $userId = User::where('department_id', $departmentId)->pluck('id')->toArray();
    $shiftId = Shift::where('department_id', $departmentId)->pluck('id')->toArray();
    $operatorTypeId = OperatorType::where('department_id', $departmentId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Dasbor - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Dasbor Supervisor";
    $viewData["operator"] = User::where('role', 'operator')->where('department_id', $departmentId)->count();
    $viewData["shift"] = Shift::whereIn('id', $shiftId)->count();
    $viewData["operator_type"] = OperatorType::whereIn('id', $operatorTypeId)->count();
    $viewData["schedule"] = Schedule::whereIn('user_id', $userId)->count();
    
    return view('supervisor.dashboard.index')->with("viewData", $viewData);
  }
}