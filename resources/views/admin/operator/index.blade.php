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
            <div class="card-header">
                <h4 class="card-title">Hoverable rows</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <p>Add <code class="highlighter-rouge">.table-hover</code> to enable a hover state on table
                        rows
                        within a
                        <code class="highlighter-rouge">&lt;tbody&gt;</code>.
                    </p>
                    <div>
                    <a href="{{ route('admin.operator.create') }}"><button class="btn btn-primary">Tambah Operator Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor Pegawai</th>
                                <th>Perusahaan</th>
                                <th>Departemen</th>
                                <th>Jenis Operator</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['operator'] as $operators)
                            <tr>
                                <td class="text-bold-500">{{ $operators->getId() }}</td>
                                <td>{{ $operators->getName() }}</td>
                                <td>{{ $operators->getEmployeeId() }}</td>
                                <td>{{ $operators->getCompanyId() }}</td>
                                <td>{{ $operators->getDepartmentId() }}</td>
                                <td class="text-bold-500">{{ $operators->getEmail() }}</td>
                                <td>{{ $operators->getPhoneNumber() }}</td>
                                <td>{{ $operators->getName() }}</td>
                                <td>
                                    <a href="{{route('admin.operator.edit', ['id'=> $operators->getId()])}}">Edit</a>
                                    <form action="{{ route('admin.operator.delete', $operators->getId())}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">
                                        <i class="bi-trash">Hapus</i>
                                        </button>
                                    </form><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail badge-circle badge-circle-light-secondary font-medium-1"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection