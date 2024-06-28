<?php

namespace App\Http\Controllers\Operator;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class OperatorProfileController extends Controller
{
  public function index()
  {
    $id = Auth::user()->id;
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Profil";
    $viewData["profile"] = User::where('id', $id)->get();
    return view('operator.profile.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Profil - Penjadwalan Shift Kerja Operator";
    $viewData["subtitle"] = "Edit Profil";
    $viewData["profile"] = User::findOrFail($id);
    return view('operator.profile.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  { 
    $operator = User::findOrFail($id);
    $operator->setName($request->input('full_name'));
    $operator->setEmployeeId($request->input('employee_id'));
    $operator->setEmail($request->input('email'));
    $operator->setPhoneNumber($request->input('phone_number'));
    $operator->save();

    return redirect()->route('operator.profile.index');
  }
}