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
    <form method="POST" action="{{ route('superadmin.company.update', ['id'=> $viewData['company']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="company-name-horizontal">Nama Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="company_name" value="{{ $viewData['company']->getCompanyName() }}" id="company-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                          <div class="mb-3 row">
                                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Alamat</label>
                                            <div class="col-lg-10 col-md-6 col-sm-12">
                                                <textarea id="company_address" name="company_address" class="form-control" rows="4">{{ $viewData['company']->getCompanyAddress() }}</textarea>
                                            </div>
                                          </div>
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