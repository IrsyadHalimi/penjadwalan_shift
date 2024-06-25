<?php

namespace App\Http\Controllers\Supervisor;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


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

  public function validateData(Request $request)
  {
    $rules = [
        'full_name' => 'required|string|max:50',
        'employee_id' => 'required',
        'phone_number' => 'required|max:20',
        'email' => 'required|string|email|max:50',
    ];

    $messages = [
        'full_name.required' => 'Nama lengkap harus diisi.',
        'full_name.string' => 'Nama harus berupa string.',
        'full_name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
        'employee_id.required' => 'Nomor pegawai harus diisi.',
        'phone_number.required' => 'Nomor telepon harus diisi.',
        'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.string' => 'Email harus berupa string.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
    ];

    return Validator::make($request->all(), $rules, $messages);
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
    $validator = $this->validateData($request);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $supervisor = User::findOrFail($id);
    $supervisor->setName($request->input('full_name'));
    $supervisor->setEmployeeId($request->input('employee_id'));
    $supervisor->setEmail($request->input('email'));
    $supervisor->setPhoneNumber($request->input('phone_number'));
    $supervisor->save();

    return redirect()->route('supervisor.profile.index')->with('success', 'Data berhasil diperbarui.');
  }
}