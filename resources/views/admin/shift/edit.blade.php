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

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.shift.update', ['id'=> $viewData['shift']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nama Shift</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="shift_name" value="{{ $viewData['shift']->getShiftName() }}" id="shift-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id"  id="basicSelect">
                                                <option value="" hidden>-- Pilih Departemen --</option>
                                                @foreach($viewData['department'] as $departments)
                                                <option value="{{ $departments->getId() }}" {{ $departments->getId() == $viewData['shift']->getDepartmentId() ? 'selected' : null }}>{{ $departments->getDepartmentName() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Waktu Masuk</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="time" name="start_time" value="{{ $viewData['shift']->getStartTime() }}" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Waktu Keluar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="time" name="end_time" value="{{ $viewData['shift']->getEndTime() }}" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="label-color-horizontal">Warna Label Shift</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                          <select id="label_color" class="form-select @error('label_color') is-invalid @enderror" name="label_color"  id="basicSelect">
                                            <option value="" hidden>-- Pilih Warna Label --</option>
                                            <option class="text-primary" value="primary" {{ $viewData['shift']->getLabelColor() == 'primary' ? 'selected' : null }} >Biru</option>
                                            <option class="text-success" value="success" {{ $viewData['shift']->getLabelColor() == 'success' ? 'selected' : null }} >Hijau</option>
                                            <option class="text-warning" value="warning" {{ $viewData['shift']->getLabelColor() == 'warning' ? 'selected' : null }} >Kuning</option>
                                            <option class="text-dark" value="dark" {{ $viewData['shift']->getLabelColor() == 'success' ? 'dark' : null }} >Hitam</option>
                                            <option class="text-danger" value="danger" {{ $viewData['shift']->getLabelColor() == 'danger' ? 'selected' : null }} >Merah</option>
                                            <option class="text-secondary" value="secondary" {{ $viewData['shift']->getLabelColor() == 'secondary' ? 'selected' : null }} >Abu-abu</option>
                                            <option class="text-info" value="info" {{ $viewData['shift']->getLabelColor() == 'info' ? 'selected' : null }} >Biru Muda</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="5">{{ $viewData['shift']->getDescription() }}</textarea>
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