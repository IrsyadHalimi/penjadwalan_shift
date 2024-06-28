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
        $viewData["title"] = "Login - Penjadwalan Shift Kerja Operator";
        $viewData["subtitle"] = "Home";
        if (Auth::user()) {
            return response()->noContent();
        } else {
            return view('auth.login')->with("viewData", $viewData);
        }
    }
}