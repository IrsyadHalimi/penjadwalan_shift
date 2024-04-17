<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminOperatorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Operator";
    $viewData["operator"] = User::where('role', 'operator')->get();
    return view('admin.operator.index')->with("viewData", $viewData);
  }
  
  // public function show($id)
  // {
  //   $viewData = [];
  //   $jadwal = Shift::findOrFail($id);
  //   $viewData["title"] = $jadwal["tanggal"]." - Penjadwalan Shift";
  //   $viewData["subtitle"] = $jadwal["tanggal"]." - Informasi";
  //   $viewData["jadwal"] = $jadwal;
  //   return view('admin.jadwal.show')->with("viewData", $viewData);
  // }

  // public function store(Request $request)
  // {
  //   User::validate($request); 
  //   $newUser = new Shift();
  //   $newShift->setShiftName($request->input('nama_shift'));
  //   $newShift->setStartTime($request->input('jam_masuk'));
  //   $newShift->setEndTime($request->input('jam_keluar'));
  //   $newShift->setNote($request->input('keterangan'));
  //   $newShift->save();

  //   return back();
  // }

  public function edit($id_user)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Operator";
    $viewData["subtitle"] = "Edit Operator";
    $viewData["operator"] = User::where('id_user', $id_user)->first();
    return view('admin.operator.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id_user)
  {
    User::validate($request); 
    $user = User::where('id_user', $id_user)->first();
    $user->setName($request->input('nama_lengkap'));
    $user->setEmployeeNumber($request->input('nomor_pegawai'));
    $user->setEmail($request->input('email'));
    $user->setDepartment($request->input('departemen'));
    $user->setPhoneNumber($request->input('nomor_telepon'));
    $user->setRole($request->input('role'));
    $user->save();

    return redirect()->route('admin.operator.index');
  }

  public function delete($id_user)
  {
    User::destroy($id_user);
    return back();
  }
}