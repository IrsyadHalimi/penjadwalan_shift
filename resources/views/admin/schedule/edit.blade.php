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

  <section id="basic-horizontal-layouts">
    <form method="POST" action="{{ route('admin.schedule.update', ['id'=> $viewData['schedule']->getId()]) }}"
    enctype="multipart/form-data">
      @csrf
      @method('PUT')
        <div class="row match-height">
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title">Horizontal Form</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <livewire:admin-edit-schedule-dropdown :scheduleId="$viewData['schedule']->getId()" />
                                        @livewireScripts
                                        <div class="col-md-4">
                                            <label for="start_date-horizontal">Tanggal Mulai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="start_date" id="start_date-horizontal" class="form-control" value="{{ $viewData['schedule']->getStartDate() }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="end_date-horizontal">Tanggal Selesai</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="date" name="end_date" id="end_date-horizontal" class="form-control" value="{{ $viewData['schedule']->getEndDate() }}" required>
                                        </div>
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </form>
    </section>
</div>
@endsection