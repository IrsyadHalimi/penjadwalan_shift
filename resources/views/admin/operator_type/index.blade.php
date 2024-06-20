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
                    <a href="{{ route('admin.operator_type.create') }}"><button class="btn btn-primary">Tambah Jenis Operator Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-3">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Jenis Operator</th>
                                <th>Departemen</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['operator_type'] as $operator_types)
                            <tr>
                                <td class="text-bold-500">{{ $operator_types->getId() }}</td>
                                <td>{{ $operator_types->getOperatorNameType() }}</td>
                                <td>{{ $operator_types->department->department_name }}</td>
                                <td>{{ $operator_types->getDescription() }}</td>
                                <td>
                                    <a href="{{route('admin.operator_type.edit', ['id'=> $operator_types->getId()])}}">Edit</a>
                                    <form action="{{ route('admin.operator_type.delete', $operator_types->getId())}}" method="POST">
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
                <div class="d-flex justify-content-center mt-4">
                    {{ $viewData['operator_type']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection