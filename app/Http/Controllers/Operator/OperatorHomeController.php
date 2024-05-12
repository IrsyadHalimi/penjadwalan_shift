<?php

namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;

class OperatorHomeController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Home - Penjadwalan Shift";
    $viewData["subtitle"] = "Home Operator";
    $viewData["jadwal"] = Jadwal::all();
    $viewData["user"] = User::all();
    return view('operator.home.index')->with("viewData", $viewData);
  }
} 