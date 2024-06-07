<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SuperAdminCompanyAdminController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Admin Perusahaan - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Admin Perusahaan";
    $viewData["company_admin"] = User::where('role', 'admin')->get();
    return view('superadmin.company_admin.index')->with("viewData", $viewData);
  }
  
  public function create()
  {
    $viewData = [];
    $viewData["title"] = " Tambah Admin Perusahan- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Admin Perusahaan";
    $viewData["company"] = Company::all();
    return view('superadmin.company_admin.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $companyId = $request->input('company_id');
    $id = $companyId . 'ADM' . Str::random(3);

    User::validate($request); 
    $newUser = new User();
    $newUser->setId($id);
    $newUser->setName($request->input('full_name'));
    $newUser->setEmployeeId($request->input('employee_id'));
    $newUser->setEmail($request->input('email'));
    $newUser->setPhoneNumber($request->input('phone_number'));
    $newUser->setPassword(Hash::make($request->input('password')));
    $newUser->setRole('admin');
    $newUser->save();

    return redirect()->route('superadmin.company_admin.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "SuperAdmin - Edit Admin Perusahaan";
    $viewData["subtitle"] = "Edit Admin Perusahaan";
    $viewData["company_admin"] = User::findOrFail($id);
    return view('superadmin.company_admin.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    User::validate($request); 
    $company_admin = User::findOrFail($id);
    $company_admin->setName($request->input('full_name'));
    $company_admin->setEmployeeId($request->input('employee_id'));
    $company_admin->setEmail($request->input('email'));
    $company_admin->setPhoneNumber($request->input('phone_number'));
    $company_admin->save();

    return redirect()->route('superadmin.company_admin.index');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back();
  }
}