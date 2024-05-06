@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  <a href="{{ route('admin.department.create') }}">Create Departemen</a>
</div>
<div class="row">
  @foreach ($viewData["department"] as $departments)
  ID: {{ $departments->getId() }}
  Nama Departemen: {{ $departments->getDepartmentName() }}
  <a href="{{route('admin.department.edit', ['id'=> $departments->getId()])}}">Edit</a>
  <form action="{{ route('admin.department.delete', $departments->getId())}}" method="POST">
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