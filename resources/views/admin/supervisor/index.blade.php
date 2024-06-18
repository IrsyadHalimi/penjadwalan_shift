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
                    Data dalam tabel dibawah merupakan seluruh supervisor dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.supervisor.create') }}"><button class="btn btn-primary">Tambah Supervisor Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-3">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor Pegawai</th>
                                <th>Perusahaan</th>
                                <th>Departemen</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['supervisor'] as $supervisors)
                            <tr>
                                <td class="text-bold-500">{{ $supervisors->getId() }}</td>
                                <td>{{ $supervisors->getName() }}</td>
                                <td>{{ $supervisors->getEmployeeId() }}</td>
                                <td>{{ $supervisors->company ? $supervisors->company->company_name : 'N/A' }}</td>
                                <td>{{ $supervisors->department ? $supervisors->department->department_name : 'N/A' }}</td>
                                <td>{{ $supervisors->getEmail() }}</td>
                                <td>{{ $supervisors->getPhoneNumber() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('admin.supervisor.edit', ['id'=> $supervisors->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('admin.supervisor.delete', $supervisors->getId())}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn icon btn-danger">
                                            <i class="bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
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