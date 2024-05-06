<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

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
    return view('superadmin.shift.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    Shift::validate($request); 
    $newShift = new Shift();
    $newShift->setShiftName($request->input('shift_name'));
    $newShift->setDepartmentId($request->input('department_id'));
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