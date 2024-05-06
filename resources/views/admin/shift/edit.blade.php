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
    <form method="POST" action="{{ route('admin.shift.update', ['id'=> $viewData['shift']->getId()]) }}"
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
                                            <label for="shift-name-horizontal">Nama Shift</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="shift_name" value="{{ $viewData['supervisor']->getName() }}" id="first-name-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="employeeId-horizontal">Nomor Pegawai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="employee_id" value="{{ $viewData['supervisor']->getEmployeeId() }}" id="employeeId-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department-horizontal">Departemen</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="department_id" value="{{ $viewData['supervisor']->getDepartmentId() }}" id="department-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="email-horizontal">Email</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="email" name="email" value="{{ $viewData['supervisor']->getEmail() }}" id="email-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="phone-horizontal">Nomor Telepon</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" name="phone_number" value="{{ $viewData['supervisor']->getPhoneNumber() }}" id="phone-horizontal" class="form-control">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="role-horizontal">Role (Jabatan)</label>
                                        </div>
                                        <div class="col-md-8 form-group">  
                                          <select id="role" class="form-select @error('role') is-invalid @enderror" name="role"  id="basicSelect">
                                            <option value="">-- Pilih Role --</option>
                                            <option value="admin">Admin</option>
                                            <option value="supervisor" selected>Supervisor</option>
                                            <option value="operator">Operator</option>
                                          </select>
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

  <form method="POST" action="{{ route('admin.shift.update', ['id'=> $viewData['shift']->getId()]) }}"
  enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Nama Shift</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="shift_name" value="{{ $viewData['shift']->getShiftName() }}" type="text" class="form-control">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Masuk</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
            <input class="form-control" type="time" name="start_time" value="{{ $viewData['shift']->getStartTime() }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Jam Keluar</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
          <input class="form-control" type="time" name="end_time" value="{{ $viewData['shift']->getEndTime() }}">
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
        <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Warna Label Shift</label>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'success' ? 'checked' : null }} type="radio" name="label_color" id="category-success" value="success">
            <label class="form-check-label" for="category-success">Hijau</label>
          </div>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'danger' ? 'checked' : null }} type="radio" name="label_color" id="category-danger" value="danger">
            <label class="form-check-label" for="category-danger">Merah</label>
          </div>
          <div class="form-check form-check-inline">
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'warning' ? 'checked' : null }} type="radio" name="label_color" id="category-warning" value="warning">
            <label class="form-check-label" for="category-warning">Kuning</label>
          </div>
          <div>
            <input class="form-check-input" {{ $viewData['shift']->getLabelColor() == 'primary' ? 'checked' : null }} type="radio" name="label_color" id="category-primary" value="primary">
            <label class="form-check-label" for="category-primary">Biru</label>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Keterangan</label>
          <div class="col-lg-10 col-md-6 col-sm-12">
              <textarea id="keterangan" name="notes" class="form-control" rows="4">{{ $viewData['shift']->getNotes() }}</textarea>
          </div>
        </div>
      </div>
    </div>
    <div class="col">
      &nbsp;
    </div>
  </div>
  <div>
    Klik tombol Perbarui untuk menyimpan perubahan
  </div>
  <button type="submit" class="btn btn-primary">Perbarui</button>
  </form>
</div>
@endsection