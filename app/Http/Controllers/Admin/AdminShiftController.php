<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class AdminShiftController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Shift Kerja";
    $viewData['shift'] = Shift::whereIn('department_id', $departmentId)->paginate(10);
    return view('admin.shift.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Shift Kerja";
    $viewData["department"] = Department::where('company_id', $companyId)->get();
    return view('admin.shift.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $departmentId = $request->input('department_id');
    $shiftId = 'SHF' . $departmentId . Str::random(2);
    
    Shift::validate($request);
    $newShift = new Shift();
    $newShift->setId($shiftId);
    $newShift->setShiftName($request->input('shift_name'));
    $newShift->setDepartmentId($departmentId);
    $newShift->setStartTime($request->input('start_time'));
    $newShift->setEndTime($request->input('end_time'));
    $newShift->setDescription($request->input('description'));
    $newShift->setLabelColor($request->input('label_color'));
    $newShift->save();

    return redirect()->route('admin.shift.index');
  }

  public function edit($id)
  {
    $companyId = Auth::user()->company_id;
    
    $viewData = [];
    $viewData["title"] = "Admin - Edit Shift";
    $viewData["subtitle"] = "Edit Shift Kerja";
    $viewData["shift"] = Shift::findOrFail($id);
    $viewData["department"] = Department::where('company_id', $companyId)->paginate(10);
    return view('admin.shift.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    Shift::validate($request); 
    $shift = Shift::findOrFail($id);
    $shift->setShiftName($request->input('shift_name'));
    $shift->setDepartmentId($request->input('department_id'));
    $shift->setStartTime($request->input('start_time'));
    $shift->setEndTime($request->input('end_time'));
    $shift->setDescription($request->input('description'));
    $shift->save();

    return redirect()->route('admin.shift.index');
  }

  public function delete($id)
  {
    Shift::destroy($id);
    return back();
  }
}