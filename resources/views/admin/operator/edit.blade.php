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

  <form method="POST" action="{{ route('admin.operator.update', ['id_user'=> $viewData['operator']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Lengkap</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nama_lengkap" value="{{ $viewData['operator']->getName() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Pegawai</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nomor_pegawai" value="{{ $viewData['operator']->getEmployeeNumber() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="email" value="{{ $viewData['operator']->getEmail() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Departemen</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="departemen" value="{{ $viewData['operator']->getDepartment() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Telepon</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nomor_telepon" value="{{ $viewData['operator']->getPhoneNumber() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jabatan (Role)</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
              <option value="">-- Pilih Role --</option>
              <option value="admin">Admin</option>
              <option value="supervisor">Supervisor</option>
              <option value="operator" selected>Operator</option>
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      &nbsp;
    </div>
  </div>
  <div>
    Klik tombol Perbarui untuk menyimpan perubahan
  </div>
  <button type="submit" class="btn btn-primary">Perbarui</button>
  </form>
</div>
@endsection