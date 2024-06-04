<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminShiftController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Shift Kerja";
    $viewData['shifts'] = Shift::with('department')->get();
    return view('admin.shift.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Shift Kerja";
    $viewData["department"] = Department::all();
    return view('admin.shift.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $company_id = Auth::user()->company_id;
    $shiftCount = Shift::count();
    $id = $company_id . 'dep' . str_pad($shiftCount + 1, 3, '0', STR_PAD_LEFT);
    Shift::validate($request); 
    $newShift = new Shift();
    $newShift->setId($id);
    $newShift->setShiftName($request->input('shift_name'));
    $newShift->setDepartmentId($request->input('department_id'));
    $newShift->setStartTime($request->input('start_time'));
    $newShift->setEndTime($request->input('end_time'));
    $newShift->setNotes($request->input('notes'));
    $newShift->setLabelColor($request->input('label_color'));
    $newShift->save();

    return redirect()->route('admin.shift.index');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Shift";
    $viewData["subtitle"] = "Edit Shift Kerja";
    $viewData["shift"] = Shift::findOrFail($id);
    $viewData["department"] = Department::all();
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
    $shift->setNotes($request->input('notes'));
    $shift->save();

    return redirect()->route('admin.shift.index');
  }

  public function delete($id)
  {
    Shift::destroy($id);
    return back();
  }
}