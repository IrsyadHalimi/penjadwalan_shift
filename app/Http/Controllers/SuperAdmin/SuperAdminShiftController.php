<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SuperAdminShiftController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Shift Kerja";
    $viewData["shift"] = Shift::all();
    return view('superadmin.shift.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Shift Kerja";
    $viewData["department"] = Department::all();
    return view('superadmin.shift.create')->with("viewData", $viewData);
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
    $newShift->setNotes($request->input('notes'));
    $newShift->setLabelColor($request->input('label_color'));
    $newShift->save();

    return redirect()->route('superadmin.shift.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "SuperAdmin - Edit Shift";
    $viewData["subtitle"] = "Edit Shift Kerja";
    $viewData["shift"] = Shift::findOrFail($id);
    $viewData["department"] = Department::all();
    return view('superadmin.shift.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    Shift::validate($request); 
    $shift = Shift::findOrFail($id);
    $shift->setShiftName($request->input('shift_name'));
    $shift->setDepartmentId($request->input('department_id'));
    $shift->setStartTime($request->input('start_time'));
    $shift->setEndTime($request->input('end_time'));
    $shift->setNotes($request->input('notes'));
    $shift->save();

    return redirect()->route('superadmin.shift.index');
  }

  public function delete($id)
  {
    Shift::destroy($id);
    return back();
  }
}