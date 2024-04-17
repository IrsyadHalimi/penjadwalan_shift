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
  @foreach ($viewData["operator"] as $operator)
  ID: {{ $operator->getId() }}
  Nama: {{ $operator->getName() }}
  Departemen: {{ $operator->getDepartment() }}
  Email: {{ $operator->getEmail() }}
  Jabatan: {{ $operator->getRole() }}
  <a href="{{route('admin.operator.edit', ['id_user'=> $operator->getId()])}}">Edit</a>
  <form action="{{ route('admin.operator.delete', $operator->getId())}}" method="POST">
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