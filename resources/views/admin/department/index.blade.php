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
                <h4 class="card-title">Data Departemen</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.department.create') }}"><button class="btn btn-primary">Tambah Departemen Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Departemen</th>
                                <th>Keterangan</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['departments'] as $department)
                            <tr>
                                <td class="text-bold-500">{{ $department->getId() }}</td>
                                <td>{{ $department->getDepartmentName() }}</td>
                                <td>{{ $department->getDescription() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('admin.department.edit', ['id'=> $department->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('admin.department.delete', $department->getId())}}" method="POST">
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
                    {{ $viewData['departments']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection