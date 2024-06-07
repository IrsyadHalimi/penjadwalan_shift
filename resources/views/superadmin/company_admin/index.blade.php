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
                <h4 class="card-title">Data Admin Perusahaan</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data Admin Perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('superadmin.company_admin.create') }}"><button class="btn btn-primary">Tambah Admin Perusahaan Baru</button></a>
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
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['company_admin'] as $companies_admin)
                            <tr>
                                <td class="text-bold-500">{{ $companies_admin->getId() }}</td>
                                <td>{{ $companies_admin->getName() }}</td>
                                <td>{{ $companies_admin->getEmployeeId() }}</td>
                                <td>{{ $companies_admin->company ? $companies_admin->company->company_name : 'N/A' }}</td>
                                <td>{{ $companies_admin->getEmail() }}</td>
                                <td>{{ $companies_admin->getPhoneNumber() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('superadmin.company_admin.edit', ['id'=> $companies_admin->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('superadmin.company_admin.delete', $companies_admin->getId())}}" method="POST">
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