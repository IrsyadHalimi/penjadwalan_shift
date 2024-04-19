<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Departemen;
use Illuminate\Http\Request;

class AdminDepartemenController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Departemen";
    $viewData["departemen"] = Departemen::all();
    return view('admin.departemen.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Departemen - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Departemen";
    return view('admin.departemen.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    Departemen::validate($request); 
    $newDepartemen = new Departemen();
    $newDepartemen->setDepartemenName($request->input('nama_departemen'));
    $newDepartemen->setNote($request->input('keterangan'));
    $newDepartemen->save();

    return redirect()->route('admin.departemen.index');
  }

  public function edit($id_departemen)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Departemen";
    $viewData["subtitle"] = "Edit Departemen";
    $viewData["departemen"] = Departemen::where('id_departemen', $id_departemen)->first();
    return view('admin.departemen.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id_departemen)
  {
    Departemen::validate($request); 
    $departemen = Departemen::where('id_departemen', $id_departemen)->first();
    $departemen->setDepartemenName($request->input('nama_departemen'));
    $departemen->setNote($request->input('keterangan'));
    $departemen->save();

    return redirect()->route('admin.departemen.index');
  }

  public function delete($id_departemen)
  {
    Shift::destroy($id_departemen);
    return back();
  }
}