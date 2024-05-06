@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
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
                        <a href="{{ route('admin.shift.create') }}"><button class="btn btn-primary">Tambah Shift Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Shift</th>
                                <th>Departemen</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Keterangan</th>
                                <th>Warna Label</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['shift'] as $shifts)
                            <tr>
                                <td class="text-bold-500">{{ $shifts->getId() }}</td>
                                <td>{{ $shifts->getShiftName() }}</td>
                                <td>{{ $shifts->getDepartmentId() }}</td>
                                <td>{{ $shifts->getStartTime() }}</td>
                                <td>{{ $shifts->getEndTime() }}</td>
                                <td>{{ $shifts->getNotes() }}</td>
                                <td><button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></td>
                                <td>
                                    <a href="{{route('admin.shift.edit', ['id'=> $shifts->getId()])}}">Edit</a>
                                    <form action="{{ route('admin.shift.delete', $shifts->getId())}}" method="POST">
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
<div class="row">
  @foreach ($viewData["shift"] as $shift)
  ID: {{ $shift->getId() }}
  Nama Shift: {{ $shift->getShiftName() }}
  Jam Masuk: {{ $shift->getStartTime() }}
  Jam Keluar: {{ $shift->getEndTime() }}
  Keterangan: {{ $shift->getNotes() }}
  <a href="{{route('admin.shift.edit', ['id'=> $shift->getId()])}}">Edit</a>
  <form action="{{ route('admin.shift.delete', $shift->getId())}}" method="POST">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">
      <i class="bi-trash">Hapus</i>
    </button>
  </form>
  <br>
  @endforeach
</div>
@endsection