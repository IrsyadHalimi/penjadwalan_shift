@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">{{ $viewData['subtitle'] }}</h4>
                <p>
                    Cetak seluruh jadwal shift kerja operator ke file PDF yang terdapat pada departemen yang sama
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <a href="{{ route('supervisor.report.generateAllSchedulePdf') }}"><button class="btn btn-primary"><i class="bi bi-download"></i> Cetak Seluruh Jadwal</button></a>
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
                    <form class="form form-horizontal" action="{{ route('supervisor.report.generateByRangePdf') }}" method="post">
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
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">Data Jadwal Berdasarkan Jenis Operator</h4>
                <p>
                    Cetak seluruh jadwal shift kerja operator ke file PDF berdasarkan jenis operator
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                    <form class="form form-horizontal" action="{{ route('supervisor.report.generateByOperatorTypePdf') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <input type="text" value="{{ Auth::user()->department_id }}" name="department_id" hidden>
                                <div class="col-md-4">
                                    <label for="department-horizontal">Pilih Jenis Operator</label>
                                </div>
                                <div class="col-md-8 form-group">  
                                    <select id="operator_type_id" class="form-select @error('operator_type_id') is-invalid @enderror" name="operator_type_id"  id="basicSelect">
                                        <option value="" hidden>-- Pilih Jenis Operator --</option>
                                        @foreach($viewData['operator_type'] as $operator_type)
                                        <option value="{{ $operator_type->getId() }}">{{ $operator_type->getOperatorNameType() }}</option>
                                        @endforeach
                                    </select>
                                </div>
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