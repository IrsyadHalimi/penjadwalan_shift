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

  <form method="POST" action="{{ route('admin.jadwal.update', ['id_jadwal'=> $viewData['jadwal']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pilih User:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <select name="id_user">
              @foreach($viewData['user'] as $user)
                <option value="{{ $user->getid() }}" @if($user->getId() == $viewData['jadwal']->getUserId()) selected @endif>{{ $user->getName() }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Pilih Shift:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <select name="id_shift">
              @foreach($viewData['shift'] as $shift)
                <option value="{{ $shift->getId() }}" @if($shift->getId() == $viewData['jadwal']->getShiftId()) selected @endif>{{ $shift->getShiftName() }}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Tanggal:</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input class="form-control" type="date" name="tanggal" value="{{ $viewData['jadwal']->tanggal }}" min="{{ today()->format('Y-m-d') }}">
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