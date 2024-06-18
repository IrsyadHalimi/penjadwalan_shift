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
                <h4 class="card-title">Data Jadwal</h4>
                <p>
                    Data dalam tabel dibawah merupakan seluruh data jadwal shift kerja operator dari berbagai departemen yang terdapat pada perusahaan
                </p>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <div>
                        <a href="{{ route('admin.schedule.create') }}"><button class="btn btn-primary">Tambah jadwal Baru</button></a>
                    </div>
                </div>
                <!-- table hover -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0 mx-4">
                        <thead>
                            <tr>
                                <th>ID Jadwal</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Nama Operator</th>
                                <th>Shift</th>
                                <th>Warna Label</th>
                                <th> </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($viewData['schedules'] as $schedule)
                            <tr>
                                <td class="text-bold-500">{{ $schedule->getId() }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->getStartDate())->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($schedule->getEndDate())->format('d-m-Y') }}</td>
                                <td>{{ $schedule->user->full_name }}</td>
                                <td>{{ $schedule->shift->shift_name }}</td>
                                <td><button class="btn btn-{{ $schedule->shift->label_color }} px-4"></button></td>
                                <td>
                                    <a class="btn icon btn-primary" href="{{route('admin.schedule.edit', ['id'=> $schedule->getId()])}}"><i class="bi-pen"></i></a>
                                </td>    
                                <td>
                                    <form action="{{ route('admin.schedule.delete', $schedule->getId())}}" method="POST">
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
            <div class="d-flex justify-content-center mt-4">
                {{ $viewData['schedules']->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
@endsection