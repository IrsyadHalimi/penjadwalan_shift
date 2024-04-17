@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  <a href="{{ route('admin.shift.create') }}">Create Shift</a>
</div>
<div class="row">
  @foreach ($viewData["shift"] as $shift)
  ID: {{ $shift->getId() }}
  Nama Shift: {{ $shift->getShiftName() }}
  Jam Masuk: {{ $shift->getStartTime() }}
  Jam Keluar: {{ $shift->getEndTime() }}
  Keterangan: {{ $shift->getNote() }}
  <a href="{{route('admin.shift.edit', ['id_shift'=> $shift->getId()])}}">Edit</a>
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