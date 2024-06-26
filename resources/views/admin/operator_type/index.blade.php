@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
@if(session('success'))
    <div class="alert alert-light-success alert-dismissible show fade">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('fail'))
    <div class="alert alert-light-danger alert-dismissible show fade">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<div class="row" id="table-hover-row">
    <div class="col-12">
        <div class="card">
            <div class="card-header pb-0">
                <h4 class="card-title">{{ $viewData['subtitle'] }}</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh jenis operator yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.operator_type.create') }}"><button class="btn btn-primary">Tambah Jenis Operator Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Jenis Operator</th>
                                <th>Departemen</th>
                                <th>Keterangan</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($viewData['operator_type'] as $operator_types)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-bold-500">{{ $operator_types->getId() }}</td>
                                <td>{{ $operator_types->getOperatorNameType() }}</td>
                                <td>{{ optional($operator_types->department)->department_name ?? 'N/A'}}</td>
                                <td>{{ $operator_types->getDescription() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="#" data-url="{{route('admin.operator_type.edit', ['id'=> $operator_types->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                                        <i class="bi-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="deleteForm-{{ $operator_types->getId() }}" action="{{ route('admin.operator_type.delete', $operator_types->getId())}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $operator_types->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                                        <i class="bi-trash"></i>
                                    </button>
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