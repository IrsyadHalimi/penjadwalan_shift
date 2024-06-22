<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminSupervisorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Admin - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Supervisor";
    return view('admin.supervisor.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = " Tambah Supervisor- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Supervisor";
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.supervisor.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $companyId = Auth::user()->company_id;
    $id = $companyId . 'SPV' . Str::random(4);

    User::validate($request);
    $newUser = new User();
    $newUser->setId($id);
    $newUser->setName($request->input('full_name'));
    $newUser->setEmployeeId($request->input('employee_id'));
    $newUser->setEmail($request->input('email'));
    $newUser->setPhoneNumber($request->input('phone_number'));
    $newUser->setPassword(Hash::make($request->input('password')));
    $newUser->setDepartmentId($request->input('department_id'));
    $newUser->setCompanyId($companyId);
    $newUser->setRole('supervisor');
    $newUser->save();

    return redirect()->route('admin.supervisor.index');
  }

  public function edit($id)
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = "Admin - Edit Supervisor";
    $viewData["subtitle"] = "Edit Supervisor";
    $viewData["supervisor"] = User::findOrFail($id);
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.supervisor.edit')->with("viewData", $viewData);
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
    $user->setCompanyId(Auth::user()->company_id);
    $user->setPhoneNumber($request->input('phone_number'));
    $user->setRole('supervisor');
    $user->save();

    return redirect()->route('admin.supervisor.index');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back();
  }
}