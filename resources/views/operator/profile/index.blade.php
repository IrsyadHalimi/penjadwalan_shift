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
                    Data dalam tabel dibawah merupakan seluruh data shift kerja operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                @foreach ($viewData['profile'] as $operator)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nama Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $operator->getName() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $operator->getEmployeeId() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ optional($operator->department)->department_name ?? N/A }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Jenis Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $operator->operatorType->operator_name_type }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $operator->getPhoneNumber() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $operator->getEmail() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal"></label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted"><a class="btn icon btn-primary" href="{{route('operator.profile.edit', ['id'=> $operator->getId()])}}">Edit Profil <i class="bi-pen"></i></a></h6>
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