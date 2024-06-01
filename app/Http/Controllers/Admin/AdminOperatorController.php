<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Shift;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOperatorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Operator";
    $viewData["operator"] = User::where('role', 'operator')->get();
    return view('admin.operator.index')->with("viewData", $viewData);
  }
  
  public function create()
  {
    $viewData = [];
    $viewData["title"] = " Tambah Operator- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Operator";
    $viewData["department"] = Department::all();
    $viewData["operator_type"] = OperatorType::all();
    return view('admin.operator.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    User::validate($request); 
    $newUser = new User();
    $newUser->setName($request->input('full_name'));
    $newUser->setEmployeeId($request->input('employee_id'));
    $newUser->setEmail($request->input('email'));
    $newUser->setPhoneNumber($request->input('phone_number'));
    $newUser->setPassword(Hash::make($request->input('password')));
    $newUser->setDepartmentId($request->input('department_id'));
    $newUser->setOperatorTypeId($request->input('operator_type_id'));
    $newUser->setCompanyId(Auth::user()->company_id);
    $newUser->setRole('operator');
    $newUser->save();

    return redirect()->route('admin.operator.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Operator";
    $viewData["subtitle"] = "Edit Operator";
    $viewData["operator"] = User::findOrFail($id);
    $viewData["department"] = Department::all();
    $viewData["shift"] = Shift::all();
    $viewData["operator_type"] = OperatorType::all();
    return view('admin.operator.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    User::validate($request); 
    $user = User::findOrFail($id);
    $user->setCompanyId($request->input('company_id'));
    $user->setDepartmentId($request->input('department_id'));
    $user->setName($request->input('full_name'));
    $user->setEmployeeId($request->input('employee_id'));
    $user->setEmail($request->input('email'));
    $user->setPhoneNumber($request->input('phone_number'));
    $user->setOperatorTypeId($request->input('operator_type_id'));
    $user->setCompanyId(Auth::user()->company_id);
    $user->setRole($request->input('role'));
    $user->save();

    return redirect()->route('admin.operator.index');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back();
  }
}