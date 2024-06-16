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
                <h4 class="card-title">Profil</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data shift kerja operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                @foreach ($viewData['profile'] as $admins)
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nama Admin</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $admins->getName() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $admins->getEmployeeId() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $admins->getPhoneNumber() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted">: {{ $admins->getEmail() }}</h6>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="shift-name-horizontal"></label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <h6 class="text-muted"><a class="btn icon btn-primary" href="{{route('admin.profile.edit', ['id'=> $admins->getId()])}}">Edit Profil <i class="bi-pen"></i></a></h6>
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