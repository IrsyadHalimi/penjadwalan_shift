<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

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
    // $company_id = auth()->user()->company_id;
    $newDepartment = new Department();
    $newDepartment->setDepartmentName($request->input('department_name'));
    // $newDepartment->setCompanyId($company_id);
    $newDepartment->setCompanyId(11111);
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
    Shift::destroy($id);
    return back();
  }
}