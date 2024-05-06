<!-- @extends('layouts.app')
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
  @foreach ($viewData["jadwal"] as $jadwal)
  <a>{{ $jadwal->getDate() }}</a>
  <a>{{ $jadwal->getUserId() }}</a>
  <a>{{ $jadwal->getId() }}</a>
  <a>{{ $jadwal->getCreatedAt() }}</a>
  @endforeach
</div>
@endsection -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  INI HOME ADMIN
</body>
</html>