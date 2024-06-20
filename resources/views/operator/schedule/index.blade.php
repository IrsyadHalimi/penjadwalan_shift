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
<div class="row" id="table-hover-row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4 class="card-title">Jadwal Shift Kerja</h4>
            <p>Keterangan Label Shift</p>
            <div class="row">
                @foreach ($viewData['shift'] as $shifts)
                <div class="col-6 col-lg-3 col-md-3">{{ $shifts->getShiftName() }}<br>({{ $shifts->getStartTime() }} - {{ $shifts->getEndTime() }})
                    <button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></br>
                </div>
                @endforeach
            </div>
          </div>
          <div class="card-content">
              <div class="card-body">
                <form class="form form-horizontal" action="{{ route('operator.schedule.generatePdf') }}" method="post">
                  @csrf
                  <div class="form-body">
                      <div class="row">
                          <div class="col-md-4">
                              <label for="start_date-horizontal">Jadwal Dari</label>
                          </div>
                          <div class="col-md-8 form-group">
                              <input type="date" name="start_date" id="start_date-horizontal" class="form-control" required>
                          </div>
                          <div class="col-md-4">
                              <label for="end_date-horizontal">Hingga</label>
                          </div>
                          <div class="col-md-8 form-group">
                              <input type="date" name="end_date" id="end_date-horizontal" class="form-control" required>
                          </div>
                          <div class="col-sm-12 d-flex justify-content-end">
                              <button type="submit" class="btn btn-primary me-1 mb-1">Cetak PDF</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div id='calendar'></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="modal-action" class="modal" tabindex="-1">
    </div>
</div>
@endsection
@section('inline-script')
<script>
    const modal = $('#modal-action')
    const csrfToken = $('meta[name=csrf_token]').attr('content')

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            locale: 'id',
            buttonText: {
              today: 'Hari ini',
            },
            events: `{{ route('operator.schedule.list') }}`,
            editable: false, // Mengubah editable menjadi false agar tidak dapat dilakukan resize atau drop event
        });
        calendar.render();
    });
</script>
@endsection