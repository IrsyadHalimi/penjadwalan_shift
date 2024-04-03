@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  Create Product
</div>
<div>
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif
  <form method="POST" action="{{ route('admin.jadwal.store') }}">
  @csrf
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pilih Operator:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <select name="id_user">
              @foreach($viewData['jadwal'] as $jadwal)
                <option value="{{ $jadwal->id_user }}">{{ $jadwal->id_user }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pilih Shift:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <select name="id_user">
              @foreach($viewData['jadwal'] as $jadwal)
                <option value="{{ $jadwal->id_shift }}">{{ $jadwal->id_shift }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tanggal:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input name="tanggal" type="date" class="form-control">
          </div>
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
<div class="row">
  @foreach ($viewData["jadwal"] as $jadwal)
  <a>{{ $jadwal->getDate() }}</a>
  <a>{{ $jadwal->getUser() }}</a>
  <a>{{ $jadwal->getId() }}</a>
  <a>{{ $jadwal->getCreatedAt() }}</a>
  @endforeach
</div>
@endsection