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
                <h4 class="card-title">Data Shift</h4>
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
                                <th>ID</th>
                                <th>Nama Shift</th>
                                <th>Departemen</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
                                <th>Keterangan</th>
                                <th>Warna Label</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['shift'] as $shifts)
                            <tr>
                                <td class="text-bold-500">{{ $shifts->getId() }}</td>
                                <td>{{ $shifts->getShiftName() }}</td>
                                <td>{{ $shifts->department ? $shifts->department->department_name : 'N/A' }}</>
                                <td>{{ $shifts->getStartTime() }}</td>
                                <td>{{ $shifts->getEndTime() }}</td>
                                <td>{{ $shifts->getDescription() }}</td>
                                <td><button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('admin.shift.edit', ['id'=> $shifts->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('admin.shift.delete', $shifts->getId())}}" method="POST">
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
                    {{ $viewData['shift']->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection