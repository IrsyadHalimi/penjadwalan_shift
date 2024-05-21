<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Home - Penjadwalan Shift";
        $viewData["subtitle"] = "Home";
        return view('error.error404')->with("viewData", $viewData);
    }
}