@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif
  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('superadmin.company_admin.store') }}">
      @csrf
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Tambah Data Admin Perusahaan Baru</h4>
                        <p>
                            Formulir dibawah berfungsi untuk menambahkan data Admin Perusahaan baru kedalam salah satu perusahaan
                        </p>
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
                                            <input type="text" name="full_name" id="first-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employeeId-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="employee_id" id="employeeId-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                          <label for="phone-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="number" name="phone_number" id="phone-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" name="email" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone-horizontal">Password</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="password" name="password" id="password-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone-horizontal">Perusahaan</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                            <select id="company_id" class="form-select @error('company_id') is-invalid @enderror" name="company_id"  id="basicSelect">
                                                <option value="" hidden>-- Pilih Perusahaan --</option>
                                                @foreach($viewData['company'] as $companies)
                                                <option value="{{ $companies->getId() }}">{{ $companies->getCompanyName() }}</option>
                                                @endforeach
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