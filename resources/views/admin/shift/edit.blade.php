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

  <form method="POST" action="{{ route('admin.shift.update', ['id_shift'=> $viewData['shift']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Shift</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="nama_shift" value="{{ $viewData['shift']->getShiftName() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Masuk</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input class="form-control" type="time" name="jam_masuk" value="{{ $viewData['shift']->jam_masuk }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Keluar</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input class="form-control" type="time" name="jam_keluar" value="{{ $viewData['shift']->jam_keluar }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Keterangan</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <textarea id="keterangan" name="keterangan" class="form-control" rows="4">{{ $viewData['shift']->getNote() }}</textarea>
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