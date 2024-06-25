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
<div>
  <a href="{{ route('admin.shift.create') }}">Create Shift</a>
</div>
<div class="row">
  @foreach ($viewData["shift"] as $shift)
  ID: {{ $shift->getId() }}
  Nama Shift: {{ $shift->getShiftName() }}
  Jam Masuk: {{ $shift->getStartTime() }}
  Jam Keluar: {{ $shift->getEndTime() }}
  Keterangan: {{ $shift->getDescription() }}
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