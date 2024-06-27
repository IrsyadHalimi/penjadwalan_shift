<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;


class SuperadminCompanyController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Perusahaan - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Perusahaan";
    $viewData["company"] = Company::paginate(10);
    return view('superadmin.company.index')->with("viewData", $viewData);
  }

  public function create()
  {
    $viewData = [];
    $viewData["title"] = "Perusahaan - Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Perusahaan";
    return view('superadmin.company.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $companyName = $request->input('company_name');
    $companyId = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $companyName), 0, 3)) . Str::random(3);
    
    $newCompany = new Company();
    $newCompany->setId($companyId);
    $newCompany->setCompanyName($companyName);
    $newCompany->setCompanyAddress($request->input('company_address'));
    $newCompany->setDescription($request->input('description'));
    $newCompany->save();

    return redirect()->route('superadmin.company.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Perusahaan";
    $viewData["subtitle"] = "Edit Perusahaan";
    $viewData["company"] = Company::findOrFail($id);
    return view('superadmin.company.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $company = Company::findOrFail($id);
    $company->setCompanyName($request->input('company_name'));
    $company->setCompanyAddress($request->input('company_address'));
    $company->setDescription($request->input('description'));
    $company->save();

    return redirect()->route('superadmin.company.index')->with('success', 'Data berhasil diperbarui.');
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