@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif
  <form method="POST" action="{{ route('admin.department.store') }}">
  @csrf
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Departemen</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="department_name" type="text" class="form-control">
          </div>
        </div>
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
@endsection