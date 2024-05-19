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
  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.shift.store') }}">
      @csrf
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
                                            <label for="shift-name-horizontal">Nama Shift</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="shift_name" id="shift-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="departmentId-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="department_id" id="departmentId-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Jam Masuk</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="date" name="start_time" class="form-control flatpickr-time-picker-24h" placeholder="Select time..">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="start-horizontal">Jam Keluar</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <input type="date" name="end_time" class="form-control flatpickr-time-picker-24h" placeholder="Select time..">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="label-color-horizontal">Warna Label</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="label_color" id="label-color-horizontal" class="form-control">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Keterangan</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                          <textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="5"></textarea>
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
@endsection