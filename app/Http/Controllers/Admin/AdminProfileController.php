<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminProfileController extends Controller
{
  public function index()
  {
    $userId = Auth::user()->id;
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Perusahaan";
    $viewData["admin"] = User::where('id', $userId)->get();
    return view('admin.profile.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Profil";
    $viewData["subtitle"] = "Edit Profil";
    $viewData["admin"] = User::findOrFail($id);
    return view('admin.profile.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  { 
    $admin = User::findOrFail($id);
    $admin->setName($request->input('full_name'));
    $admin->setEmployeeId($request->input('employee_id'));
    $admin->setEmail($request->input('email'));
    $admin->setPhoneNumber($request->input('phone_number'));
    $admin->save();

    return redirect()->route('admin.profile.index');
  }

  public function delete($id)
  {
    Company::destroy($id);
    return back();
  }
}