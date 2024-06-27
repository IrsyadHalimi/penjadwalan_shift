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
    <form method="POST" action="{{ route('superadmin.operator_type.update', ['id'=> $viewData['operator_type']->getId()]) }}"
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
                                            <label for="operator_type-name-horizontal">Nama Jenis Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="operator_name_type" value="{{ $viewData['operator_type']->getOperatorNameType() }}" id="operator_type-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="operator-type-horizontal">Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="5">{{ $viewData['operator_type']->getDescription() }}</textarea>
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