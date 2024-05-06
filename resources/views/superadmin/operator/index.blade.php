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
<div class="row">
<a href="{{ route('admin.operator.create') }}">Tambah Operator Baru</a>
  @foreach ($viewData["operator"] as $operators)
  ID: {{ $operators->getId() }}
  Nama: {{ $operators->getName() }}
  Perusahaan: {{ $operators->getCompanyId() }}
  Departemen: {{ $operators->getDepartmentId() }}
  Email: {{ $operators->getEmail() }}
  Jabatan: {{ $operators->getRole() }}
  <a href="{{route('admin.operator.edit', ['id'=> $operators->getId()])}}">Edit</a>
  <form action="{{ route('admin.operator.delete', $operators->getId())}}" method="POST">
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