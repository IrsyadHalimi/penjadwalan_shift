<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class SuperadminDepartmentController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Daftar Departemen";
    return view('superadmin.department.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Tambah Departemen";
    $viewData["company"] = Company::all();
    return view('superadmin.department.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $departmentName = $request->input('department_name');
    $companyId = $request->input('company_id');
    $departmentId = 'DEP' . $companyId . Str::random(4);

    $newDepartment = new Department();
    $newDepartment->setId($departmentId);
    $newDepartment->setDepartmentName($departmentName);
    $newDepartment->setCompanyId($companyId);
    $newDepartment->save();

    return redirect()->route('superadmin.department.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Departemen";
    $viewData["departments"] = Department::findOrFail($id);
    return view('superadmin.department.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $department = Department::findOrFail($id);
    $department->setDepartmentName($request->input('department_name'));
    $department->setDescription($request->input('description'));
    $department->save();

    return redirect()->route('superadmin.department.index')->with('success', 'Data berhasil diperbarui.');
  }

  public function delete($id)
  {
    try {
      $department = Department::findOrFail($id);
      $department->delete();

      return redirect()->route('superadmin.department.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('superadmin.department.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('superadmin.department.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}