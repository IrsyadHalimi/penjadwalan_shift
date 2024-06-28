<?php

namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OperatorSupervisorController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Auth::user()->department_id;
    
    $viewData = [];
    $viewData["department_data"] = Department::where('id', $departmentId)->first();
    $viewData["title"] = "Supervisor - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Daftar Supervisor";
    $viewData["supervisor"] = User::where('company_id', $companyId)->where('department_id', $departmentId)->where('role', 'supervisor')->paginate(10);
    return view('operator.supervisor.index')->with("viewData", $viewData);
  }
}