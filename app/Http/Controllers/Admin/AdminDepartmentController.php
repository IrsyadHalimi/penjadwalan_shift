<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminDepartmentController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Departemen";
    $viewData["department"] = Department::all();
    return view('admin.department.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Departemen";
    return view('admin.department.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    Department::validate($request); 
    
    $departmentName = $request->input('department_name');
    $companyId = Auth::user()->company_id;
    $departmentId = $companyId . strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $departmentName), 0, 3)) . Str::random(2);
    
    $newDepartment = new Department();
    $newDepartment->setId($departmentId);
    $newDepartment->setDepartmentName($departmentName);
    $newDepartment->setCompanyId($companyId);
    $newDepartment->save();

    return redirect()->route('admin.department.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Departemen";
    $viewData["subtitle"] = "Edit Departemen";
    $viewData["department"] = Department::findOrFail($id);
    return view('admin.department.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    Department::validate($request); 
    $department = Department::findOrFail($id);
    $department->setDepartmentName($request->input('department_name'));
    $department->save();

    return redirect()->route('admin.department.index');
  }

  public function delete($id)
  {
    Department::destroy($id);
    return back();
  }
}