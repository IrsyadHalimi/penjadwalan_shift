@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
    @foreach($errors->all() as $error)
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endforeach
    </div>
    @endif
  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.operator.store') }}">
      @csrf
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Tambah Data Operator Baru</h4>
                        <p>
                            Formulir dibawah berfungsi untuk menambahkan data Operator baru kedalam salah satu departemen di perusahaan
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
                                            <input type="text" name="full_name" class="form-select @error('department_id') is-invalid @enderror" id="basicSelect" value="{{ old('full_name') }}" required autocomplete="full_name" autofocus>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employeeId-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="employee_id" id="employeeId-horizontal" class="form-control" value="{{ old('employee_id') }}" required autocomplete="employee_id" autofocus>
                                        </div>
                                    </div>
                                    <livewire:admin-department-operator-dropdown />
                                    @livewireScripts
                                    <div class="row">    
                                        <div class="col-md-4">
                                          <label for="phone-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="number" name="phone_number" id="phone-horizontal" class="form-control" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone-horizontal">Password</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="password" name="password" id="password-horizontal" class="form-control">
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Simpan</button>
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
