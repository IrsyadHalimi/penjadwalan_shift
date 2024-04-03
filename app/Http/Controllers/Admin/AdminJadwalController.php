<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AdminJadwalController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Jadwal - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Jadwal Kerja";
    $viewData["jadwal"] = Jadwal::all();
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
    $request->validate([
      "id_user" => "required",
      "id_shift" => "required",
      "tanggal" => "required",
    ]);
    
    $newProduct = new Product();
    $newProduct->setUser($request->input('id_user'));
    $newProduct->setShift($request->input('id_shift'));
    $newProduct->setDate($request->input('tanggal'));
    $newProduct->save();
    return back();
  }
}