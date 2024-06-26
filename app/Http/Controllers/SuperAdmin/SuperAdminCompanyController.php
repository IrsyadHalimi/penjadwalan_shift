<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


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
    try {
      $company = Company::findOrFail($id);
      $company->delete();

      return redirect()->route('superadmin.company.index')->with('success', 'Data berhasil dihapus.');
    } catch (QueryException $e) {
      if($e->getCode() == 1451) {
          return redirect()->route('superadmin.company.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
      }
      return redirect()->route('superadmin.company.index')->with('fail', 'Tidak dapat menghapus data, karena masih memiliki keterkaitan dengan data lain!');
    }
  }
}