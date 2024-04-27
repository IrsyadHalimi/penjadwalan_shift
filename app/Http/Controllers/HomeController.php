<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Home - Penjadwalan Shift";
        $viewData["subtitle"] = "Home";
        return view('auth.login')->with("viewData", $viewData);
    }
}