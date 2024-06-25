<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class SuperadminSupervisorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Superadmin - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Supervisor";
    $viewData["supervisor"] = User::where('role', 'supervisor')->get();
    return view('superadmin.supervisor.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = " Tambah Supervisor- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Supervisor";
    return view('superadmin.supervisor.create')->with("viewData", $viewData);
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
    $newUser->setCompanyId(1111);
    $newUser->setRole('supervisor');
    $newUser->save();

    return redirect()->route('superadmin.supervisor.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Superadmin - Edit Supervisor";
    $viewData["subtitle"] = "Edit Supervisor";
    $viewData["supervisor"] = User::findOrFail($id);
    return view('superadmin.supervisor.edit')->with("viewData", $viewData);
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
    $user->setRole($request->input('role'));
    $user->save();

    return redirect()->route('superadmin.supervisor.index');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back()->with('success', 'Data berhasil dihapus.');
  }
}