<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
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
        if (Auth::user()) {
            return response()->noContent();
        } else {
            return view('auth.login')->with("viewData", $viewData);
        }
    }
    
    public function error()
    {
        $viewData = [];
        $viewData["title"] = "Home - Penjadwalan Shift";
        $viewData["subtitle"] = "Home";
        return view('error.error404')->with("viewData", $viewData);
    }
}