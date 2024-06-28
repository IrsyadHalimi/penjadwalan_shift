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
            <div class="card-header">
                <h4 class="card-title">{{ $viewData['subtitle'] }}</h4>
            </div>
            <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                @foreach ($viewData['company'] as $companies)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">ID Perusahaan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $companies->getId() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nama Perusahaan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $companies->getCompanyName() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Alamat Perusahaan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $companies->getCompanyAddress() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $companies->getDescription() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal"></label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted"><a class="btn icon btn-primary" href="{{route('admin.company.edit', ['id'=> $companies->getId()])}}">Edit Perusahaan <i class="bi-pen"></i></a></h6>
                                        </div>
                                    </div>
                                @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection