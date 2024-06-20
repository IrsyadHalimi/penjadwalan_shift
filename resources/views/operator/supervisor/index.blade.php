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
                <h4 class="card-title">Data Supervisor</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data supervisor dari departemen {{ $viewData['department_data']->getDepartmentName() }}
                </p>
            </div>
            <div class="card-content">
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Supervisor</th>
                                <th>Nomor Pegawai</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['supervisor'] as $supervisors)
                            <tr>
                                <td class="text-bold-500">{{ $supervisors->getId() }}</td>
                                <td>{{ $supervisors->getName() }}</td>
                                <td>{{ $supervisors->getEmployeeId() }}</td>
                                <td>{{ $supervisors->getEmail() }}</td>
                                <td>{{ $supervisors->getPhoneNumber() }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $viewData['supervisor']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection