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
                <h4 class="card-title">Data Operator</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.operator.create') }}"><button class="btn btn-primary">Tambah Operator Baru</button></a>
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
                                <th>Jenis Operator</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['operator'] as $operators)
                            <tr>
                                <td class="text-bold-500">{{ $operators->getId() }}</td>
                                <td>{{ $operators->getName() }}</td>
                                <td>{{ $operators->getEmployeeId() }}</td>
                                <td>{{ $operators->company ? $operators->company->company_name : 'N/A' }}</td>
                                <td>{{ $operators->department ? $operators->department->department_name : 'N/A' }}</td>
                                <td>{{ $operators->operatorType ? $operators->operatorType->operator_name_type : 'N/A' }}</td>
                                <td>{{ $operators->getEmail() }}</td>
                                <td>{{ $operators->getPhoneNumber() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('admin.operator.edit', ['id'=> $operators->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('admin.operator.delete', $operators->getId())}}" method="POST">
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
            </div>
        </div>
    </div>
</div>
@endsection