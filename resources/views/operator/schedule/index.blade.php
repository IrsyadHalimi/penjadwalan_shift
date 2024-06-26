@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row" id="table-hover-row">
  <div class="col-12">
      <div class="card">
          <div class="card-header">
            <h4 class="card-title">Jadwal Shift Kerja</h4>
          </div>
          <div class="card-content">
              <div class="card-body py-0 my-0">
                <form class="form form-horizontal" action="{{ route('operator.schedule.generatePdf') }}" method="post">
                  @csrf
                  <div class="form-body">
                      <div class="row">
                          <h6 class="card-title">Cetak PDF jadwal shift kerja</h6>
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
                <div class="card-body mb-3 pb-3">
                  <p>Keterangan Label Shift</p>
                  <div class="row">
                      @foreach ($viewData['shift'] as $shifts)
                      <div class="col-8 col-lg-4 col-md-4">{{ $shifts->getShiftName() }} ({{ $shifts->getStartTime() }} - {{ $shifts->getEndTime() }})
                          <button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></>
                      </div>
                      @endforeach
                  </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-8 mb-5">
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
            editable: false,
            eventClick: function({
                event
            }) {
                $.ajax({
                    url: `{{ url('operator/schedule') }}/${event.id}/edit`,
                    success: function(res) {
                        modal.html(res).modal('show')

                        $('#form-action').on('submit', function(e) {
                            e.preventDefault()
                            const form = this
                            const formData = new FormData(form)
                            $.ajax({
                                url: form.action,
                                method: form.method,
                                data: formData,
                                processData: false,
                                contentType: false,
                                success: function(res) {
                                  modal.modal('hide')
                                  calendar.refetchEvents()
                                  iziToast.success({
                                    title: 'Sukses',
                                    message: res.message,
                                    position: 'topRight'
                                  });
                                }
                            })
                        })
                    }
                })
            },
        });
        calendar.render();
    });
</script>
@endsection