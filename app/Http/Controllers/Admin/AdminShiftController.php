<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class AdminShiftController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Shift - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Shift Kerja";
    $viewData["shift"] = Shift::all();
    return view('admin.shift.index')->with("viewData", $viewData);
  }
  
  public function show($id)
  {
    $viewData = [];
    $jadwal = Shift::findOrFail($id);
    $viewData["title"] = $jadwal["tanggal"]." - Penjadwalan Shift";
    $viewData["subtitle"] = $jadwal["tanggal"]." - Informasi";
    $viewData["jadwal"] = $jadwal;
    return view('admin.jadwal.show')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    Shift::validate($request); 
    $newShift = new Shift();
    $newShift->setShiftName($request->input('nama_shift'));
    $newShift->setStartTime($request->input('jam_masuk'));
    $newShift->setEndTime($request->input('jam_keluar'));
    $newShift->setNote($request->input('keterangan'));
    $newShift->save();

    return back();
  }

  public function edit($id_shift)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Shift";
    $viewData["subtitle"] = "Edit Shift Kerja";
    $viewData["shift"] = Shift::where('id_shift', $id_shift)->first();
    return view('admin.shift.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id_shift)
  {
    Shift::validate($request); 
    $shift = Shift::where('id_shift', $id_shift)->first();
    $shift->setShiftName($request->input('nama_shift'));
    $shift->setStartTime($request->input('jam_masuk'));
    $shift->setEndTime($request->input('jam_keluar'));
    $shift->setNote($request->input('keterangan'));
    $shift->save();

    return redirect()->route('admin.shift.index');
  }
}