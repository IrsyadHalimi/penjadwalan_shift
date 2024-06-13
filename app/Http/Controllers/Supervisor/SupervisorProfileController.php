<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SupervisorProfileController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Perusahaan";
    $viewData["profile"] = User::where('id', $id)->get();
    return view('supervisor.profile.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Profil";
    $viewData["subtitle"] = "Edit Profil";
    $viewData["profile"] = User::findOrFail($id);
    return view('supervisor.profile.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  { 
    $supervisor = User::findOrFail($id);
    $supervisor->setName($request->input('full_name'));
    $supervisor->setEmployeeId($request->input('employee_id'));
    $supervisor->setEmail($request->input('email'));
    $supervisor->setPhoneNumber($request->input('phone_number'));
    $supervisor->save();

    return redirect()->route('supervisor.profile.index');
  }
}