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
    <form method="POST" action="{{ route('admin.shift.store') }}">
      @csrf
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Tambah Data Shift Baru</h4>
                        <p>
                            Formulir dibawah berfungsi untuk menambahkan data shift baru kedalam salah satu departemen di perusahaan
                        </p>
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
                                        <input type="text" name="shift_name" id="shift-name-horizontal" class="form-control @error('shift_name') is-invalid @enderror" value="{{ old('shift_name') }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="department-horizontal">Departemen</label>
                                    </div>
                                    <div class="col-md-8 form-group">  
                                        <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id" id="basicSelect">
                                            <option value="" hidden>-- Pilih Departemen --</option>
                                            @foreach($viewData['departments'] as $departments)
                                                <option value="{{ $departments->getId() }}" {{ old('department_id') == $departments->getId() ? 'selected' : '' }}>{{ $departments->getDepartmentName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="start-horizontal">Waktu Mulai</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="time" name="start_time" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu" value="{{ old('start_time') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="end-horizontal">Waktu Selesai</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="time" name="end_time" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu" value="{{ old('end_time') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="label-color-horizontal">Warna Label Shift</label>
                                    </div>
                                    <div class="col-md-8 form-group">  
                                        <select id="label_color" class="form-select @error('label_color') is-invalid @enderror" name="label_color"  id="basicSelect">
                                            <option value="" hidden>-- Pilih Warna Label --</option>
                                            <option class="text-primary" value="primary" {{ old('label_color') == 'primary' ? 'selected' : '' }}>Biru</option>
                                            <option class="text-success" value="success" {{ old('label_color') == 'success' ? 'selected' : '' }}>Hijau</option>
                                            <option class="text-warning" value="warning" {{ old('label_color') == 'warning' ? 'selected' : '' }}>Kuning</option>
                                            <option class="text-dark" value="dark" {{ old('label_color') == 'dark' ? 'selected' : '' }}>Hitam</option>
                                            <option class="text-danger" value="danger" {{ old('label_color') == 'danger' ? 'selected' : '' }}>Merah</option>
                                            <option class="text-secondary" value="secondary" {{ old('label_color') == 'secondary' ? 'selected' : '' }}>Abu-abu</option>
                                            <option class="text-info" value="info" {{ old('label_color') == 'info' ? 'selected' : '' }}>Biru Muda</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="description-horizontal">Keterangan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{ old('description') }}</textarea>
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
@endsection