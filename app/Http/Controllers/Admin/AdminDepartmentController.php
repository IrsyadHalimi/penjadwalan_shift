<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class AdminDepartmentController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Departemen";
    $viewData["departments"] = Department::where('company_id', $companyId)->paginate(10);
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
    $departmentName = $request->input('department_name');
    $companyId = Auth::user()->company_id;
    $departmentId = 'DEP' . $companyId . Str::random(4);
    
    $newDepartment = new Department();
    $newDepartment->setId($departmentId);
    $newDepartment->setDepartmentName($departmentName);
    $newDepartment->setCompanyId($companyId);
    $newDepartment->setDescription($request->input('description'));
    $newDepartment->save();

    return redirect()->route('admin.department.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Departemen";
    $viewData["subtitle"] = "Edit Departemen";
    $viewData["departments"] = Department::findOrFail($id);
    return view('admin.department.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $department = Department::findOrFail($id);
    $department->setDepartmentName($request->input('department_name'));
    $department->setDescription($request->input('description'));
    $department->save();

    return redirect()->route('admin.department.index')->with('success', 'Data berhasil diperbarui.');
  }

  public function delete($id)
  {
    try {
      $department = Department::findOrFail($id);
      $department->delete();

      return redirect()->route('admin.department.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('admin.department.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('admin.department.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}