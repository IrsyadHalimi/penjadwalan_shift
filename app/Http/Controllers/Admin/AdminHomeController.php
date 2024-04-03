<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Jadwal - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Jadwal Kerja";
    $viewData["jadwal"] = Jadwal::all();
    return view('admin.jadwal.index')->with("viewData", $viewData);
  }
} 