@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  <a href="{{ route('admin.supervisor.create') }}">Tambah Supervisor baru</a>
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