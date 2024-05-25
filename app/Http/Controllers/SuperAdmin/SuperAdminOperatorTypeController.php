<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\OperatorType;
use Illuminate\Http\Request;

class SuperAdminOperatorTypeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Jenis Operator";
    $viewData["operator_type"] = OperatorType::all();
    return view('superadmin.operator_type.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Jenis Operator";
    return view('superadmin.operator_type.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    OperatorType::validate($request); 
    // $company_id = auth()->user()->company_id;
    $newOperatorType = new OperatorType();
    $newOperatorType->setOperatorNameType($request->input('operator_name_type'));
    $newOperatorType->setNotes($request->input('notes'));
    // $newDepartment->setCompanyId($company_id);
    $newOperatorType->setDepartmentId(11111);
    $newOperatorType->save();

    return redirect()->route('superadmin.operator_type.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Jenis Operator";
    $viewData["subtitle"] = "Edit Jenis Operator";
    $viewData["operator_type"] = OperatorType::findOrFail($id);
    return view('superadmin.operator_type.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    OperatorType::validate($request); 
    $operatorType = OperatorType::findOrFail($id);
    $operatorType->setOperatorNameType($request->input('operator_name_type'));
    $operatorType->setNotes($request->input('notes'));
    $operatorType->save();

    return redirect()->route('superadmin.operator_type.index');
  }

  public function delete($id)
  {
    Company::destroy($id);
    return back();
  }
}