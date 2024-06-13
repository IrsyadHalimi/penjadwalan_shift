<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class SuperadminCompanyController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Perusahaan - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Perusahaan";
    $viewData["company"] = Company::all();
    return view('superadmin.company.index')->with("viewData", $viewData);
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "SuperAdmin - Edit Perusahaan";
    $viewData["subtitle"] = "Edit Perusahaan";
    $viewData["company"] = Company::findOrFail($id);
    return view('superadmin.company.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    Company::validate($request); 
    $company = Company::findOrFail($id);
    $company->setCompanyName($request->input('company_name'));
    $company->setCompanyAddress($request->input('company_address'));
    $company->save();

    return redirect()->route('superadmin.company.index');
  }

  public function delete($id)
  {
    Company::destroy($id);
    return back();
  }
}