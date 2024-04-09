<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Home - Penjadwalan Shift";
    $viewData["subtitle"] = "Home Admin";
    $viewData["jadwal"] = Jadwal::all();
    $viewData["user"] = User::all();
    return view('admin.home.index')->with("viewData", $viewData);
  }
} 