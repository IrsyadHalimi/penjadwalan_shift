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
                <div class="col-6 col-lg-3 col-md-3">{{ $shifts->getShiftName() }}
                    <button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></>
                </div>
                @endforeach
            </div>
          </div>
          <div class="card-content">
              <div class="card-body">
              <form class="form form-horizontal" action="{{ route('supervisor.schedule.generatePdf') }}" method="post">
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
            events: `{{ route('supervisor.schedule.list') }}`,
            editable: true,
            dateClick: function(info) {
                $.ajax({
                    url: `{{ route('supervisor.schedule.create') }}`,
                    data: {
                        start_date: info.dateStr,
                        end_date: info.dateStr
                    },
                    success: function(res) {
                        modal.html(res).modal('show')
                        $('.datepicker').datepicker({
                            todayHighlight: true,
                            format: 'yyyy-mm-dd'
                        });

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
                                      title: 'Success',
                                      message: res.message,
                                      position: 'topRight'
                                    });
                                },
                                error: function(res) {

                                }
                            })
                        })
                    }
                })
            },
            eventClick: function({
                event
            }) {
                $.ajax({
                    url: `{{ url('supervisor/schedule') }}/${event.id}/edit`,
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
                                    title: 'Success',
                                    message: res.message,
                                    position: 'topRight'
                                  });
                                }
                            })
                        })
                    }
                })
            },
            eventDrop: function(info) {
                // Menampilkan modal konfirmasi sebelum mengirim permintaan AJAX
                $('#confirmationModal').modal('show');

                // Menangani tombol "Ya" dalam modal konfirmasi
                $('#confirmButton').off('click').on('click', function() {
                    // Mengirim permintaan AJAX hanya jika pengguna mengonfirmasi
                    const event = info.event
                    $.ajax({
                        url: `{{ url('supervisor/schedule') }}/${event.id}/update`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            user_id: event.extendedProps.user_id,
                            shift_id: event.extendedProps.shift_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message
                            info.revert()
                            iziToast.error({
                                title: 'Error',
                                message: message ?? 'Something wrong',
                                position: 'topRight'
                            });
                        }
                    })
                    $('#confirmationModal').modal('hide');
                })
                // Menangani tombol "Batal" dalam modal konfirmasi
                $('#cancelButton').on('click', function() {
                    // Mengembalikan event seperti semula jika pengguna membatalkan resize
                    info.revert();
                    $('#confirmationModal').modal('hide');
                });
            },
            eventResize: function(info) {
                const event = info.event;

                // Menampilkan modal konfirmasi sebelum mengirim permintaan AJAX
                $('#confirmationModal').modal('show');

                // Menangani tombol "Ya" dalam modal konfirmasi
                $('#confirmButton').off('click').on('click', function() {
                    // Mengirim permintaan AJAX hanya jika pengguna mengonfirmasi
                    $.ajax({
                        url: `{{ url('supervisor/schedule') }}/${event.id}/update`,
                        method: 'put',
                        data: {
                            id: event.id,
                            start_date: event.startStr,
                            end_date: event.end.toISOString().substring(0, 10),
                            user_id: event.extendedProps.user_id,
                            shift_id: event.extendedProps.shift_id
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            accept: 'application/json'
                        },
                        success: function(res) {
                            iziToast.success({
                                title: 'Success',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message;
                            info.revert();
                            iziToast.error({
                                title: 'Error',
                                message: message ?? 'Something wrong',
                                position: 'topRight'
                            });
                        }
                    });
                    $('#confirmationModal').modal('hide');
                });

                // Menangani tombol "Batal" dalam modal konfirmasi
                $('#cancelButton').on('click', function() {
                    // Mengembalikan event seperti semula jika pengguna membatalkan resize
                    info.revert();
                    $('#confirmationModal').modal('hide');
                });
            }

        });
        calendar.render();
    });
</script>
@endsection