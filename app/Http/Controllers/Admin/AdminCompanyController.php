<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminCompanyController extends Controller
{
  public function index()
  {
    $companyId = Auth::user()->company_id;
    $viewData = [];
    $viewData["title"] = "Perusahaan - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Perusahaan";
    $viewData["company"] = Company::where('id', $companyId)->get();
    return view('admin.company.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Perusahaan";
    $viewData["subtitle"] = "Edit Perusahaan";
    $viewData["company"] = Company::findOrFail($id);
    return view('admin.company.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $company = Company::findOrFail($id);
    $company->setCompanyName($request->input('company_name'));
    $company->setCompanyAddress($request->input('company_address'));
    $company->setDescription($request->input('description'));
    $company->save();

    return redirect()->route('admin.company.index')->with('success', 'Data berhasil diperbarui.');
  }
}