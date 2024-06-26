@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  @if($errors->any())
<ul class="alert alert-danger alert-dismissible show fade list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endforeach
</ul>
@endif

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('operator.profile.update', ['id'=> $viewData['profile']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="full_name-horizontal">Nama Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="full_name" value="{{ $viewData['profile']->getName() }}" id="full_name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employee_id-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="employee_id" value="{{ $viewData['profile']->getEmployeeId() }}" id="employee_id-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone_number-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="phone_number" value="{{ $viewData['profile']->getPhoneNumber() }}" id="phone_number-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" name="email" value="{{ $viewData['profile']->getEmail() }}" id="email-horizontal" class="form-control">
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
</div>
@endsection