<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SupervisorOperatorController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Auth::user()->department_id;
    
    $viewData = [];
    $viewData["department_data"] = Department::where('id', $departmentId)->first();
    $viewData["title"] = "Data Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Data Operator";
    $viewData["operator"] = User::where('company_id', $companyId)->where('department_id', $departmentId)->where('role', 'operator')->paginate(10);
    return view('supervisor.operator.index')->with("viewData", $viewData);
  }
}