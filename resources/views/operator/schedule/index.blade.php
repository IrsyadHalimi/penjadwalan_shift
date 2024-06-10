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
              <h4 class="card-title">Hoverable rows</h4>
          </div>
          <div class="card-content">
              <div class="card-body">
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