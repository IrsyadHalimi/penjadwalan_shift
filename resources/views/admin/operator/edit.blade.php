@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.operator.update', ['id'=> $viewData['operator']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="first-name-horizontal">Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="full_name" value="{{ $viewData['operator']->getName() }}" id="first-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employeeId-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="employee_id" value="{{ $viewData['operator']->getEmployeeId() }}" id="employeeId-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="company-horizontal">Perusahaan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="company_id" value="{{ $viewData['operator']->getCompanyId() }}" id="company-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="department_id" value="{{ $viewData['operator']->getDepartmentId() }}" id="department-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Jenis Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="department_id" value="{{ $viewData['operator']->getDepartmentId() }}" id="department-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" name="email" value="{{ $viewData['operator']->getEmail() }}" id="email-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="phone_number" value="{{ $viewData['operator']->getPhoneNumber() }}" id="phone-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role-horizontal">Role (Jabatan)</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                          <select id="role" class="form-select @error('role') is-invalid @enderror" name="role"  id="basicSelect">
                                            <option value="">-- Pilih Role --</option>
                                            <option value="admin">Admin</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="operator" selected>Operator</option>
                                          </select>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </form>
    </section>
</div>
@endsection