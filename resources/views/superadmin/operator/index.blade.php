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
<div class="row">
<a href="{{ route('superadmin.operator.create') }}">Tambah Operator Baru</a>
  @foreach ($viewData["operator"] as $operators)
  ID: {{ $operators->getId() }}
  Nama: {{ $operators->getName() }}
  Perusahaan: {{ $operators->getCompanyId() }}
  Departemen: {{ $operators->getDepartmentId() }}
  Email: {{ $operators->getEmail() }}
  Jabatan: {{ $operators->getRole() }}
  <a href="{{route('superadmin.operator.edit', ['id'=> $operators->getId()])}}">Edit</a>
  <form action="{{ route('superadmin.operator.delete', $operators->getId())}}" method="POST">
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