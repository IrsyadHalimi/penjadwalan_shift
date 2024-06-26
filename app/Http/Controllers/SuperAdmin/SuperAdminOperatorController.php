<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department;
use App\Models\Shift;
use App\Models\OperatorType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class SuperadminOperatorController extends Controller
{
  public function index()
  {
    $viewData = [];
    $viewData["title"] = "Operator - Penjadwalan Shift";
    $viewData["subtitle"] = "Daftar Operator";
    return view('superadmin.operator.index')->with("viewData", $viewData);
  }

  public function validateCreateData(Request $request)
  {
    $rules = [
        'full_name' => 'required|string|max:50',
        'employee_id' => 'required|max:20',
        'department_id' => 'required',
        'operator_type_id' => 'required',
        'phone_number' => 'required|max:20',
        'email' => 'required|string|email|max:50|unique:users',
        'password' => 'required|string|min:8',
    ];

    $messages = [
        'full_name.required' => 'Nama lengkap harus diisi.',
        'full_name.string' => 'Nama harus berupa string.',
        'full_name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
        'employee_id.required' => 'Nomor pegawai harus diisi.',
        'employee_id.max' => 'Nomor pegawai tidak boleh lebih dari 20 karakter.',
        'department_id.required' => 'Departemen harus dipilih.',
        'operator_type_id.required' => 'Jenis operator harus dipilih.',
        'phone_number.required' => 'Nomor telepon harus diisi.',
        'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.string' => 'Email harus berupa string.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
        'email.unique' => 'Email sudah terdaftar.',
        'password.required' => 'Password harus diisi.',
        'password.string' => 'Password harus berupa string.',
        'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
    ];

    return Validator::make($request->all(), $rules, $messages);
  }
  
  public function validateEditData(Request $request)
  {
    $rules = [
        'full_name' => 'required|string|max:50',
        'employee_id' => 'required|max:20',
        'department_id' => 'required',
        'operator_type_id' => 'required',
        'phone_number' => 'required|max:20',
        'email' => 'required|string|email|max:50',
    ];

    $messages = [
        'full_name.required' => 'Nama lengkap harus diisi.',
        'full_name.string' => 'Nama harus berupa string.',
        'full_name.max' => 'Nama tidak boleh lebih dari 50 karakter.',
        'employee_id.required' => 'Nomor pegawai harus diisi.',
        'employee_id.max' => 'Nomor pegawai tidak boleh lebih dari 20 karakter.',
        'department_id.required' => 'Departemen harus dipilih.',
        'operator_type_id.required' => 'Jenis operator harus dipilih.',
        'phone_number.required' => 'Nomor telepon harus diisi.',
        'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 20 karakter.',
        'email.required' => 'Email harus diisi.',
        'email.string' => 'Email harus berupa string.',
        'email.email' => 'Format email tidak valid.',
        'email.max' => 'Email tidak boleh lebih dari 50 karakter.',
    ];

    return Validator::make($request->all(), $rules, $messages);
  }
  
  public function create()
  {
    $viewData = [];
    $viewData["title"] = " Tambah Operator- Penjadwalan Shift";
    $viewData["subtitle"] = "Tambah Operator";
    return view('superadmin.operator.create')->with("viewData", $viewData);
  }

  public function store(Request $request)
  {
    $validator = $this->validateCreateData($request);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    $companyId = $request->input('company_id');
    $id = $companyId . 'OPR' . Str::random(4);

    $newUser = new User();
    $newUser->setId($id);
    $newUser->setName($request->input('full_name'));
    $newUser->setEmployeeId($request->input('employee_id'));
    $newUser->setEmail($request->input('email'));
    $newUser->setPhoneNumber($request->input('phone_number'));
    $newUser->setPassword(Hash::make($request->input('password')));
    $newUser->setDepartmentId($request->input('department_id'));
    $newUser->setOperatorTypeId($request->input('operator_type_id'));
    $newUser->setCompanyId($companyId);
    $newUser->setRole('operator');
    $newUser->save();

    return redirect()->route('superadmin.operator.index')->with('success', 'Data berhasil ditambahkan.');
  }

  public function edit($id)
  {
    $viewData = [];
    $viewData["title"] = "Admin - Edit Operator";
    $viewData["subtitle"] = "Edit Operator";
    $viewData["operator"] = User::findOrFail($id);
    return view('superadmin.operator.edit')->with("viewData", $viewData);
  }

  public function update(Request $request, $id)
  {
    $validator = $this->validateEditData($request);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $user = User::findOrFail($id);
    $user->setName($request->input('full_name'));
    $user->setEmployeeId($request->input('employee_id'));
    $user->setEmail($request->input('email'));
    $user->setPhoneNumber($request->input('phone_number'));
    $user->setDepartmentId($request->input('department_id'));
    $user->setOperatorTypeId($request->input('operator_type_id'));
    $user->setRole('operator');
    $user->save();

    return redirect()->route('superadmin.operator.index')->with('success', 'Data berhasil diperbarui.');
  }

  public function delete($id)
  {
    User::destroy($id);
    return back()->with('success', 'Data berhasil dihapus.');
  }
}