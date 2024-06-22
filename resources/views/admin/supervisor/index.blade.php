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
                <h4 class="card-title">Data Supervisor</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data supervisor dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.supervisor.create') }}"><button class="btn btn-primary">Tambah Supervisor Baru</button></a>
                    </div>
                </div>
                <livewire:admin-supervisor-search/>
                @livewireScripts
            </div>
        </div>
    </div>
</div>
@endsection