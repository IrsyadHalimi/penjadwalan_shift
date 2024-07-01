@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
@if(session('success'))
    <div class="alert alert-light-success alert-dismissible show fade">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('fail'))
    <div class="alert alert-light-danger alert-dismissible show fade">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
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
                    <form class="form form-horizontal" action="{{ route('supervisor.report.generatePdf') }}" method="post">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="start_date-horizontal">Jadwal Dari Tanggal</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" class="form-control datepicker" id="date" name="start_date" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="end_date-horizontal">Hingga Tanggal</label>
                                </div>
                                <div class="col-md-8 form-group">
                                    <input type="text" class="form-control datepicker" id="date" name="end_date" required>
                                </div>
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
                                    <button type="reset" class="btn btn-light-secondary me-1">Reset</button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-download"></i> Cetak Jadwal</button>
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
@section('inline-script')
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'mm-dd-yyyy',
            language: 'id'
        });

        $('.monthpicker').datepicker({
            format: 'yyyy-mm',
            viewMode: 'months', 
            minViewMode: 'months',
            language: 'id'
        });
    });
</script>
@endsection