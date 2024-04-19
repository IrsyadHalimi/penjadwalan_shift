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

  <form method="POST" action="{{ route('admin.supervisor.update', ['id_user'=> $viewData['supervisor']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Lengkap</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nama_lengkap" value="{{ $viewData['supervisor']->getName() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Pegawai</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nomor_pegawai" value="{{ $viewData['supervisor']->getEmployeeNumber() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Email</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="email" value="{{ $viewData['supervisor']->getEmail() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Departemen</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="departemen" value="{{ $viewData['supervisor']->getDepartment() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nomor Telepon</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nomor_telepon" value="{{ $viewData['supervisor']->getPhoneNumber() }}" type="text" class="form-control">
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
              <option value="supervisor" selected>Supervisor</option>
              <option value="operator">Operator</option>
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