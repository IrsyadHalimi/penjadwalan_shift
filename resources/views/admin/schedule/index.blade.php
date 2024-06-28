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
                    Data dalam tabel dibawah merupakan seluruh data jadwal shift kerja operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.schedule.create') }}"><button class="btn btn-primary">Tambah jadwal Baru</button></a>
                    </div>
                </div>
                <livewire:admin-schedule-search/>
                @livewireScripts
            </div>
        </div>
    </div>
</div>
@endsection