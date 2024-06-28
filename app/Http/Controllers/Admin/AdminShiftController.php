<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use App\Models\User;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\QueryException;


class AdminShiftController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $departmentId = Department::where('company_id', $companyId)->pluck('id')->toArray();

    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Daftar Shift";
    $viewData['shift'] = Shift::whereIn('department_id', $departmentId)->paginate(10);
    return view('admin.shift.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $companyId = Auth::user()->company_id;

    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Tambah Shift";
    $viewData["departments"] = Department::where('company_id', $companyId)->get();
    return view('admin.shift.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $departmentId = $request->input('department_id');
    $shiftId = 'SHF' . $departmentId . Str::random(2);
    
    $newShift = new Shift();
    $newShift->setId($shiftId);
    $newShift->setShiftName($request->input('shift_name'));
    $newShift->setDepartmentId($departmentId);
    $newShift->setStartTime($request->input('start_time'));
    $newShift->setEndTime($request->input('end_time'));
    $newShift->setDescription($request->input('description'));
    $newShift->setLabelColor($request->input('label_color'));
    $newShift->save();

    return redirect()->route('admin.shift.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $companyId = Auth::user()->company_id;
    
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Shift";
    $viewData["shift"] = Shift::findOrFail($id);
    return view('admin.shift.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $shift = Shift::findOrFail($id);
    $shift->setShiftName($request->input('shift_name'));
    $shift->setDepartmentId($request->input('department_id'));
    $shift->setStartTime($request->input('start_time'));
    $shift->setEndTime($request->input('end_time'));
    $shift->setDescription($request->input('description'));
    $shift->save();

    return redirect()->route('admin.shift.index')->with('success', 'Data berhasil diperbarui.');
  }

  public function delete($id)
  {
    try {
      $shift = Shift::findOrFail($id);
      $shift->delete();

      return redirect()->route('admin.shift.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('admin.shift.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('admin.shift.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}