<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\OperatorType;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class SuperadminOperatorTypeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Daftar Jenis Operator";
    $viewData["operator_type"] = OperatorType::all();
    return view('superadmin.operator_type.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Tambah Jenis Operator";
    $viewData["departments"] = Department::all();
    return view('superadmin.operator_type.create')->with("viewData", $viewData);
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

    return redirect()->route('superadmin.operator_type.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Jenis Operator";
    $viewData["operator_type"] = OperatorType::findOrFail($id);
    return view('superadmin.operator_type.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $operatorType = OperatorType::findOrFail($id);
    $operatorType->setOperatorNameType($request->input('operator_name_type'));
    $operatorType->setDescription($request->input('description'));
    $operatorType->save();

    return redirect()->route('superadmin.operator_type.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function delete($id)
  {
    try {
      $operatorType = OperatorType::findOrFail($id);
      $operatorType->delete();

      return redirect()->route('superadmin.operator_type.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('superadmin.operator_type.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('superadmin.operator_type.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}