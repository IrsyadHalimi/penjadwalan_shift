@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  <a href="{{ route('admin.supervisor.create') }}">Tambah Supervisor baru</a>
</div>
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
<div class="row">
  @foreach ($viewData["supervisor"] as $supervisors)
  ID: {{ $supervisors->getId() }}
  Nama: {{ $supervisors->getName() }}
  Perusahaan: {{ $supervisors->getCompanyId() }}
  Departemen: {{ $supervisors->getDepartmentId() }}
  Email: {{ $supervisors->getEmail() }}
  <a href="{{route('admin.supervisor.edit', ['id'=> $supervisors->getId()])}}">Edit</a>
  <form action="{{ route('admin.supervisor.delete', $supervisors->getId())}}" method="POST">
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