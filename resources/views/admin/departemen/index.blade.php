@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div>
  <a href="{{ route('admin.departemen.create') }}">Create Departemen</a>
</div>
<div class="row">
  @foreach ($viewData["departemen"] as $departemen)
  ID: {{ $departemen->getId() }}
  Nama Departemen: {{ $departemen->getDepartemenName() }}
  Keterangan: {{ $departemen->getNote() }}
  <a href="{{route('admin.departemen.edit', ['id_departemen'=> $departemen->getId()])}}">Edit</a>
  <form action="{{ route('admin.departemen.delete', $departemen->getId())}}" method="POST">
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