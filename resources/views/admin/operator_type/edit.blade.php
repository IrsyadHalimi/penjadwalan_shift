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

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.operator_type.update', ['id'=> $viewData['operator_type']->getId()]) }}"
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
                                            <label for="operator_name_type-horizontal">Nama Jenis Operator</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="operator_name_type" value="{{ $viewData['operator_type']->getOperatorNameType() }}" id="operator_name_type-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id"  id="basicSelect">
                                                <option value="" hidden>-- Pilih Departemen --</option>
                                                @foreach($viewData['department'] as $departments)
                                                <option value="{{ $departments->getId() }}" {{ $departments->getId() == $viewData['operator_type']->getDepartmentId() ? 'selected' : null }}>{{ $departments->getDepartmentName() }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            <div class="mb-3 row">
                                            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Keterangan</label>
                                            <div class="col-lg-10 col-md-6 col-sm-12">
                                                <textarea id="keterangan" name="description" class="form-control" rows="4">{{ $viewData['operator_type']->getDescription() }}</textarea>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
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