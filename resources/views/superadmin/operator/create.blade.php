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
  <form method="POST" action="{{ route('superadmin.operator.store') }}">
  @csrf
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Lengkap</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="full_name" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Pegawai</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="employee_id" type="text" class="form-control">
          </div>
        </div>
      </div>
      <livewire:superadmin-department-operator-dropdown />
      @livewireScripts
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Telepon</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="phone_number" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="email" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Password</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="password" type="text" class="form-control">
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
@endsection