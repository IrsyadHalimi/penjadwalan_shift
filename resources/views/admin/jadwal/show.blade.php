@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  @foreach ($viewData["jadwal"] as $jadwal)
  ID: {{ $jadwal->getId() }}
  Tanggal: {{ $jadwal->getDate() }}
  User: {{ $jadwal->getUser() }}
  <br>
  @endforeach
</div>
@endsection