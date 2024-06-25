@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  @if($errors->any())
    <div class="alert alert-danger alert-dismissible show fade">
    @foreach($errors->all() as $error)
        {{ $error }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endforeach
    </div>
    @endif

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.supervisor.update', ['id'=> $viewData['supervisor']->getId()]) }}"
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
                                            <label for="first-name-horizontal">Nama Lengkap</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" name="full_name" value="{{ $viewData['supervisor']->getName() }}" id="first-name-horizontal" class="form-control">
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
                                            <select id="department_id" class="form-select @error('department_id') is-invalid @enderror" name="department_id"  id="basicSelect">
                                                <option value="" hidden>-- Pilih Departemen --</option>
                                                @foreach($viewData['departments'] as $departments)
                                                <option value="{{ $departments->getId() }}" {{ $departments->getId() == $viewData['supervisor']->getDepartmentId() ? 'selected' : null }}>{{ $departments->getDepartmentName() }}</option>
                                                @endforeach
                                            </select>
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