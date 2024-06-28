<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OperatorType;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class AdminOperatorTypeController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Daftar Jenis Operator";
    $viewData["operator_type"] = OperatorType::whereIn('department_id', $departmentId)->paginate(10);
    return view('admin.operator_type.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Tambah Jenis Operator";
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.operator_type.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $operatorNameType = $request->input('operator_name_type');
    $departmentId = $request->input('department_id');
    $operatorTypeId = 'OPT' . $departmentId . Str::random(2);
   
    $newOperatorType = new OperatorType();
    $newOperatorType->setId($operatorTypeId);
    $newOperatorType->setOperatorNameType($operatorNameType);
    $newOperatorType->setDepartmentId($departmentId);
    $newOperatorType->setDescription($request->input('description'));
    $newOperatorType->save();

    return redirect()->route('admin.operator_type.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $companyId = Auth::user()->company_id;
    
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Jenis Operator";
    $viewData["operator_type"] = OperatorType::findOrFail($id);
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.operator_type.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $operatorType = OperatorType::findOrFail($id);
    $operatorType->setOperatorNameType($request->input('operator_name_type'));
    $operatorType->setDepartmentId($request->input('department_id'));
    $operatorType->setDescription($request->input('description'));
    $operatorType->save();

    return redirect()->route('admin.operator_type.index')->with('success', 'Data berhasil diperbarui.');
  }

  public function delete($id)
  {
    try {
      $operatorType = OperatorType::findOrFail($id);
      $operatorType->delete();

      return redirect()->route('admin.operator_type.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('admin.operator_type.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('admin.operator_type.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}