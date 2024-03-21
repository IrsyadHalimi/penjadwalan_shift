<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Beranda - Penjadwalan Shift";
    return view('home.index')->with("viewData", $viewData);
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