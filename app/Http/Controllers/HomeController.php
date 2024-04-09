<?php

namespace App\Http\Controllers;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Home - Penjadwalan Shift";
    $viewData["subtitle"] = "Halaman Home";
    $viewData["jadwal"] = Jadwal::all();
    $viewData["user"] = User::all();
    return view('auth.login')->with("viewData", $viewData);
  
    // $viewData = [];
    // $viewData["title"] = "Beranda - Penjadwalan Shift";
    // return view('operator.index')->with("viewData", $viewData);
  }
  public function about()
  {
    $viewData = [];
    $viewData["title"] = "Website Penjadwalan Shift Operator";
    $viewData["subtitle"] = "PT. XYZ";
    $viewData["description"] = "This is an about page ...";
    $viewData["author"] = "Developed by: Your Name";
    return view('home.about')->with("viewData", $viewData);
  }
}