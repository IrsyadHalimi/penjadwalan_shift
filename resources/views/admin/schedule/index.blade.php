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
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id='calendar'></div>
        </div>
    </div>
    <div id="modal-action" class="modal" tabindex="-1">
    </div>
</div>
@endsection