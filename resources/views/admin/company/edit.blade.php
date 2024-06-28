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
    <form method="POST" action="{{ route('admin.company.update', ['id'=> $viewData['company']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ $viewData['subtitle'] }}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                    <div class="col-md-4">
                                        <label for="company-name-horizontal">Nama Perusahaan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <input type="text" name="company_name" id="company-name-horizontal" class="form-control @error('company_name') is-invalid @enderror" value="{{ $viewData['company']->getCompanyName() }}" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="company-address-horizontal">Alamat Perusahaan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea class="form-control" name="company_address" id="exampleFormControlTextarea1" rows="5">{{ $viewData['company']->getCompanyAddress() }}</textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="description-horizontal">Keterangan</label>
                                    </div>
                                    <div class="col-md-8 form-group">
                                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{ $viewData['company']->getDescription() }}</textarea>
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