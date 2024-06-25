@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
@if(session('success'))
    <div class="alert alert-light-success alert-dismissible show fade">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if(session('fail'))
    <div class="alert alert-light-danger alert-dismissible show fade">
        {{ session('fail') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
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
            events: `{{ route('superadmin.schedule.list') }}`,
            editable: true,
            dateClick: function(info) {
                $.ajax({
                    url: `{{ route('superadmin.schedule.create') }}`,
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
                                      title: 'Sukses',
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
                    url: `{{ url('superadmin/schedule') }}/${event.id}/edit`,
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
            eventDrop: function(info) {
                // Menampilkan modal konfirmasi sebelum mengirim permintaan AJAX
                $('#confirmationModal').modal('show');

                // Menangani tombol "Ya" dalam modal konfirmasi
                $('#confirmButton').off('click').on('click', function() {
                    // Mengirim permintaan AJAX hanya jika pengguna mengonfirmasi
                    const event = info.event
                    $.ajax({
                        url: `{{ url('superadmin/schedule') }}/${event.id}/update`,
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
                                title: 'Sukses',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message
                            info.revert()
                            iziToast.error({
                                title: 'Gagal, terjadi kesalahan',
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
                        url: `{{ url('superadmin/schedule') }}/${event.id}/update`,
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
                                title: 'Sukses',
                                message: res.message,
                                position: 'topRight'
                            });
                        },
                        error: function(res) {
                            const message = res.responseJSON.message;
                            info.revert();
                            iziToast.error({
                                title: 'Gagal, terjadi kesalahan',
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