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
                    Data dalam tabel dibawah merupakan seluruh data shift kerja operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.shift.create') }}"><button class="btn btn-primary">Tambah Shift Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama Shift</th>
                                <th>Departemen</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Warna Label</th>
                                <th>Keterangan</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 0;
                            @endphp
                            @foreach ($viewData['shift'] as $shifts)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td class="text-bold-500">{{ $shifts->getId() }}</td>
                                <td>{{ $shifts->getShiftName() }}</td>
                                <td>{{ optional($shifts->department)->department_name ?? 'N/A' }}</td>
                                <td>{{ $shifts->getStartTime() }}</td>
                                <td>{{ $shifts->getEndTime() }}</td>
                                <td><button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></td>
                                <td>{{ $shifts->getDescription() }}</td>
                                <td>
                                    <a class="btn icon btn-primary" href="#" data-url="{{ route('admin.shift.edit', ['id' => $shifts->getId()]) }}" onclick="showConfirmationModal(event, 'edit')">
                                        <i class="bi-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="deleteForm-{{ $shifts->getId() }}" action="{{ route('admin.shift.delete', $shifts->getId())}}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button class="btn icon btn-danger" data-form-id="deleteForm-{{ $shifts->getId() }}" onclick="showConfirmationModal(event, 'delete')">
                                        <i class="bi-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $viewData['shift']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection