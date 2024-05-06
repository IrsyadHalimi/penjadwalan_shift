@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  @foreach ($viewData["company"] as $companies)
  ID: {{ $companies->getId() }}
  Nama Departemen: {{ $companies->getDepartmentName() }}
  <a href="{{route('admin.company.edit', ['id'=> $companies->getId()])}}">Edit</a>
  <form action="{{ route('admin.company.delete', $companies->getId())}}" method="POST">
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