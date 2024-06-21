@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
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
                                            <input type="text" name="shift_name" id="shift-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id"  id="basicSelect">
                                                <option value="" hidden>-- Pilih Departemen --</option>
                                                @foreach($viewData['department'] as $departments)
                                                <option value="{{ $departments->getId() }}">{{ $departments->getDepartmentName() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Waktu Masuk</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="time" name="start_time" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Waktu Keluar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="time" name="end_time" class="form-control flatpickr-time-picker-24h" placeholder="Pilih waktu">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="label-color-horizontal">Warna Label Shift</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                          <select id="label_color" class="form-select @error('label_color') is-invalid @enderror" name="label_color"  id="basicSelect">
                                            <option value="" hidden>-- Pilih Warna Label --</option>
                                            <option class="text-primary" value="primary">Biru</option>
                                            <option class="text-success" value="success">Hijau</option>
                                            <option class="text-warning" value="warning">Kuning</option>
                                            <option class="text-dark" value="dark">Hitam</option>
                                            <option class="text-danger" value="danger">Merah</option>
                                            <option class="text-secondary" value="secondary">Abu-abu</option>
                                            <option class="text-info" value="info">Biru Muda</option>
                                          </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5"></textarea>
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
@endsection