<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SuperadminProfileController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Profil";
    $viewData["profile"] = User::where('id', $id)->get();
    return view('superadmin.profile.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Profil";
    $viewData["profile"] = User::findOrFail($id);
    return view('superadmin.profile.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  { 
    $superadmin = User::findOrFail($id);
    $superadmin->setName($request->input('full_name'));
    $superadmin->setEmployeeId($request->input('employee_id'));
    $superadmin->setEmail($request->input('email'));
    $superadmin->setPhoneNumber($request->input('phone_number'));
    $superadmin->save();

    return redirect()->route('superadmin.profile.index');
  }
}