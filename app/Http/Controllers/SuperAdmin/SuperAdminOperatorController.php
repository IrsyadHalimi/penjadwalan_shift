<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Shift;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SuperadminOperatorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Operator";
    $viewData["operator"] = User::where('role', 'operator')->get();
    return view('superadmin.operator.index')->with("viewData", $viewData);
  }
  
  public function create()
  {
    $viewData = [];
    $viewData["title"] = " Tambah Operator- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Operator";
    $viewData["departments"] = Department::all();
    $viewData["operator_type"] = OperatorType::all();
    return view('superadmin.operator.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $companyId = Auth::user()->company_id;
    $id = $companyId . 'OPR' . Str::random(4);

    User::validate($request); 
    $newUser = new User();
    $newUser->setId($id);
    $newUser->setName($request->input('full_name'));
    $newUser->setEmployeeId($request->input('employee_id'));
    $newUser->setEmail($request->input('email'));
    $newUser->setPhoneNumber($request->input('phone_number'));
    $newUser->setPassword(Hash::make($request->input('password')));
    $newUser->setDepartmentId($request->input('department_id'));
    $newUser->setOperatorTypeId($request->input('operator_type_id'));
    $newUser->setCompanyId($companyId);
    $newUser->setRole('operator');
    $newUser->save();

    return redirect()->route('superadmin.operator.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Superadmin - Edit Operator";
    $viewData["subtitle"] = "Edit Operator";
    $viewData["operator"] = User::findOrFail($id);
    $viewData["departments"] = Department::all();
    $viewData["shift"] = Shift::all();
    $viewData["operator_type"] = OperatorType::all();
    return view('superadmin.operator.edit')->with("viewData", $viewData);
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

    return redirect()->route('superadmin.operator.index');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back()->with('success', 'Data berhasil dihapus.');
  }
}