<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OperatorType;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;



class AdminOperatorTypeController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Jenis Operator";
    $viewData["operator_type"] = OperatorType::whereIn('department_id', $departmentId)->paginate(10);
    return view('admin.operator_type.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = "Jenis Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Jenis Operator";
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.operator_type.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $operatorNameType = $request->input('operator_name_type');
    $departmentId = $request->input('department_id');
    $operatorTypeId = 'OPT' . $departmentId . Str::random(2);
   
    OperatorType::validate($request); 
    $newOperatorType = new OperatorType();
    $newOperatorType->setId($operatorTypeId);
    $newOperatorType->setOperatorNameType($operatorNameType);
    $newOperatorType->setDepartmentId($departmentId);
    $newOperatorType->setDescription($request->input('description'));
    $newOperatorType->save();

    return redirect()->route('admin.operator_type.index');
  }

  public function edit($id)
  {
    $companyId = Auth::user()->company_id;
    
    $viewData = [];
    $viewData["title"] = "Admin - Edit Jenis Operator";
    $viewData["subtitle"] = "Edit Jenis Operator";
    $viewData["operator_type"] = OperatorType::findOrFail($id);
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.operator_type.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    OperatorType::validate($request); 
    $operatorType = OperatorType::findOrFail($id);
    $operatorType->setOperatorNameType($request->input('operator_name_type'));
    $operatorType->setDepartmentId($request->input('department_id'));
    $operatorType->setDescription($request->input('description'));
    $operatorType->save();

    return redirect()->route('admin.operator_type.index');
  }

  public function delete($id)
  {
    Company::destroy($id);
    return back();
  }
}