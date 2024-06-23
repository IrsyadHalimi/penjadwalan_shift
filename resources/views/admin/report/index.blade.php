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
</div>
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">Data Jadwal</h4>
                <p>
                    Cetak seluruh jadwal shift kerja operator ke file PDF yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <a href="{{ route('admin.report.generateAllSchedulePdf') }}"><button class="btn btn-primary"><i class="bi bi-download"></i> Cetak Seluruh Jadwal</button></a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">Data Jadwal Berdasarkan Rentang Waktu</h4>
                <p>
                    Cetak seluruh jadwal shift kerja operator ke file PDF berdasarkan rentang waktu
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                    <form class="form form-horizontal" action="{{ route('admin.report.generatePdf') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="start_date-horizontal">Jadwal Dari Tanggal</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="date" name="start_date" id="start_date-horizontal" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date-horizontal">Hingga Tanggal</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="date" name="end_date" id="end_date-horizontal" class="form-control" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="department-horizontal">Departemen</label>
                                </div>
                                <div class="col-md-8 form-group">  
                                    <select id="department_id" class="form-select" name="department_id"  id="basicSelect">
                                        <option value="" hidden>-- Pilih Departemen --</option>
                                        @foreach($viewData['departments'] as $departments)
                                        <option value="{{ $departments->getId() }}">{{ $departments->getDepartmentName() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <livewire:admin-department-operator-dropdown />
                                        @livewireScripts
                                <div class="col-sm-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Cetak Jadwal</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection