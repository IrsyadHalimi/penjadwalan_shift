@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
    @foreach($errors->all() as $error)
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endforeach
    </div>
    @endif

  <form method="POST" action="{{ route('admin.shift.update', ['id'=> $viewData['shift']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Shift</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="shift_name" value="{{ $viewData['shift']->getShiftName() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Masuk</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input class="form-control" type="time" name="start_time" value="{{ $viewData['shift']->getStartTime() }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Keluar</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input class="form-control" type="time" name="end_time" value="{{ $viewData['shift']->getEndTime() }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Warna Label Shift</label>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'success' ? 'checked' : null }} type="radio" name="label_color" id="category-success" value="success">
            <label class="form-check-label" for="category-success">Hijau</label>
          </div>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'danger' ? 'checked' : null }} type="radio" name="label_color" id="category-danger" value="danger">
            <label class="form-check-label" for="category-danger">Merah</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'warning' ? 'checked' : null }} type="radio" name="label_color" id="category-warning" value="warning">
            <label class="form-check-label" for="category-warning">Kuning</label>
          </div>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'primary' ? 'checked' : null }} type="radio" name="label_color" id="category-primary" value="primary">
            <label class="form-check-label" for="category-primary">Biru</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Keterangan</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <textarea id="keterangan" name="description" class="form-control" rows="4">{{ $viewData['shift']->getDescription() }}</textarea>
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