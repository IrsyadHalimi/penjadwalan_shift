<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use App\Models\Shift;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Jadwal - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Jadwal Kerja";
    $viewData["jadwal"] = Jadwal::all();
    $viewData["user"] = User::all();
    $viewData["shift"] = Shift::all();
    return view('admin.jadwal.index')->with("viewData", $viewData);
  } 
  
  public function show($id)
  {
    $viewData = [];
    $jadwal = Jadwal::findOrFail($id);
    $viewData["title"] = $jadwal["tanggal"]." - Penjadwalan Shift";
    $viewData["subtitle"] = $jadwal["tanggal"]." - Informasi";
    $viewData["jadwal"] = $jadwal;
    return view('admin.jadwal.show')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    Jadwal::validate($request); 
    $newProduct = new Jadwal();
    $newProduct->setUser($request->input('id_user'));
    $newProduct->setShift($request->input('id_shift'));
    $newProduct->setDate($request->input('tanggal'));
    $newProduct->save();

    return back();
  }

  public function edit($id_jadwal)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Jadwal";
    $viewData["jadwal"] = Jadwal::where('id_jadwal', $id_jadwal)->first();
    $viewData["user"] = User::all();
    $viewData["shift"] = Shift::all();
    return view('admin.jadwal.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id_jadwal)
  {
    Jadwal::validate($request); 
    $jadwal = Jadwal::where('id_jadwal', $id_jadwal)->first();
    $jadwal->setUser($request->input('id_user'));
    $jadwal->setShift($request->input('id_shift'));
    $jadwal->setDate($request->input('tanggal'));
    $jadwal->save();

    return redirect()->route('admin.jadwal.index');
  }
}