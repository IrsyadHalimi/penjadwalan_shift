@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  Create Shift
</div>
<div>
  @if($errors->any())
  <ul class="alert alert-danger list-unstyled">
    @foreach($errors->all() as $error)
    <li>- {{ $error }}</li>
    @endforeach
  </ul>
  @endif
</div>
<div class="row">
  @foreach ($viewData["shift"] as $shift)
  ID: {{ $shift->getId() }}
  Nama Shift: {{ $shift->getShiftName() }}
  Jam Masuk: {{ $shift->getStartTime() }}
  Jam Keluar: {{ $shift->getEndTime() }}
  Keterangan: {{ $shift->getNote() }}
  <a href="{{route('admin.shift.edit', ['id_shift'=> $shift->getId()])}}">Edit</a>
  <br>
  @endforeach
</div>
@endsection