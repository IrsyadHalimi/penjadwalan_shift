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
  @foreach ($viewData["supervisor"] as $supervisor)
  ID: {{ $supervisor->getId() }}
  Nama: {{ $supervisor->getName() }}
  Departemen: {{ $supervisor->getDepartment() }}
  Email: {{ $supervisor->getEmail() }}
  Jabatan: {{ $supervisor->getRole() }}
  <a href="{{route('admin.supervisor.edit', ['id_user'=> $supervisor->getId()])}}">Edit</a>
  <form action="{{ route('admin.supervisor.delete', $supervisor->getId())}}" method="POST">
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