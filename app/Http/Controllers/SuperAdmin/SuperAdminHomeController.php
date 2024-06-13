<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class SuperadminHomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Home - Penjadwalan Shift";
    $viewData["subtitle"] = "Home Superadmin";
    $viewData["jadwal"] = Jadwal::all();
    $viewData["user"] = User::all();
    return view('superadmin.home.index')->with("viewData", $viewData);
  }
} 