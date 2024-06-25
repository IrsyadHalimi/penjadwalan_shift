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
  <form method="POST" action="{{ route('admin.shift.store') }}">
  @csrf
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Shift</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="shift_name" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Departemen</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="department_id" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Masuk</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input class="form-control" type="time" name="start_time">
          </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Keluar</label>
        <div class="col-lg-10 col-md-6 col-sm-12">
          <input class="form-control" type="time" name="end_time">
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Warna Label Shift</label>
          <div>
            <input class="form-check-input" type="radio" name="label_color" id="category-success" value="success">
            <label class="form-check-label" for="category-success">Hijau</label>
          </div>
          <div>
            <input class="form-check-input" type="radio" name="label_color" id="category-danger" value="danger">
            <label class="form-check-label" for="category-danger">Merah</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="label_color" id="category-warning" value="warning">
            <label class="form-check-label" for="category-warning">Kuning</label>
          </div>
          <div>
            <input class="form-check-input" type="radio" name="label_color" id="category-primary" value="primary">
            <label class="form-check-label" for="category-primary">Biru</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Keterangan</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="description" type="text" class="form-control">
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
  </form>
@endsection