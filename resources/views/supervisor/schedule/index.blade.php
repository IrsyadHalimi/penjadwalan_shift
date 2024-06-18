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
                <div class="col-8 col-lg-4 col-md-4">{{ $shifts->getShiftName() }} ({{ $shifts->getStartTime() }} - {{ $shifts->getEndTime() }})
                    <button class="btn btn-{{ $shifts->getLabelColor() }} px-4"></button></>
                </div>
                @endforeach
            </div>
          </div>
          <div class="card-content">
              <div class="card-body">
                <form class="form form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="operator_type_id">Pilih Tipe Operator</label>
                            </div>
                            <div class="col-md-8 form-group">
                                <select name="operator_type_id" id="operator_type_id" class="form-control">
                                    <option value="">Pilih Tipe Operator</option>
                                    @foreach ($viewData['operator_types'] as $operatorType)
                                        <option value="{{ $operatorType->getId() }}">{{ $operatorType->getOperatorNameType() }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
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
        $('#operator_type_id').change(function() {
            var operatorTypeId = $(this).val();
            calendar.refetchEvents();
        });

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            locale: 'id',
            buttonText: {
              today: 'Hari ini',
            },
            events: function(info, successCallback, failureCallback) {
                var start = info.startStr;
                var end = info.endStr;
                var operatorTypeId = $('#operator_type_id').val();

                $.ajax({
                    url: '{{ route("supervisor.schedule.list") }}',
                    data: {
                        start: start,
                        end: end,
                        operator_type_id: operatorTypeId
                    },
                    success: function(response) {
                        var events = response;
                        successCallback(events);
                    },
                    error: function(error) {
                        failureCallback(error);
                    }
                });
            },
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
                $('#confirmationModal').modal('show');
                $('#confirmButton').off('click').on('click', function() {
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
                $('#cancelButton').on('click', function() {
                    info.revert();
                    $('#confirmationModal').modal('hide');
                });
            },
            eventResize: function(info) {
                const event = info.event;

                $('#confirmationModal').modal('show');

                $('#confirmButton').off('click').on('click', function() {
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

                $('#cancelButton').on('click', function() {
                    info.revert();
                    $('#confirmationModal').modal('hide');
                });
            }

        });
        calendar.render();
    });
</script>
@endsection