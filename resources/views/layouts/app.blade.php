<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf_token" content="{{ csrf_token() }}">
  <title>Document</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css" integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>
  <!-- header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand" href="#">Penjadwalan Shift Kerja Operator<br>PT. Sumber Makmur</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" href="#">Beranda</a>
          <a class="nav-link active" href="{{ route('admin.department.index') }}">Departemen</a>
          <a class="nav-link active" href="{{ route('admin.schedule.index') }}">Jadwal Kerja</a>
          <a class="nav-link active" href="#">Jadwal Kerja 2</a>
          <a class="nav-link active" href="#">Supervisor</a>
          <a class="nav-link active" href="{{ route('admin.operator.index') }}">Operator</a>
          <a class="nav-link active" href="{{ route('admin.shift.index') }}">Shift</a>
          <a class="nav-link active" href="#">Cetak Jadwal</a>
          <div class="vr bg-white mx-2 d-none d-lg-block"></div>
          @guest
          <a class="nav-link active" href="{{ route('login') }}">Masuk</a>
          <a class="nav-link active" href="{{ route('register') }}">Register</a>
          @else
          <form id="logout" action="{{ route('logout') }}" method="POST">
            <a role="button" class="nav-link active"
            onclick="document.getElementById('logout').submit();">Logout</a>
            @csrf
          </form>
          @endguest
        </div>
      </div>
    </div>
  </nav>
  <header class="masthead bg-primary text-white text-center py-4">
    <div class="container d-flex align-items-center flex-column">
      <h2>@yield('subtitle', 'A Laravel Online Store')</h2>
    </div>
  </header>
  <!-- header -->
  <div class="container my-4">
    @yield('content')
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('schedule.list') }}`,
            editable: true,
            dateClick: function (info) {
                $.ajax({
                    url: `{{ route('schedule.create') }}`,
                    data: {
                        start_date: info.dateStr,
                        end_date: info.dateStr
                    },
                    success: function (res) {
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
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                },
                                error: function (res) {

                                }
                            })
                        })
                    }
                })
            },
            eventClick: function ({event}) {
                $.ajax({
                    url: `{{ url('schedule') }}/${event.id}/edit`,
                    success: function (res) {
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
                                success: function (res) {
                                    modal.modal('hide')
                                    calendar.refetchEvents()
                                }
                            })
                        })
                    }
                })
            },
            eventDrop: function (info) {
                const event = info.event
                $.ajax({
                    url: `{{ url('schedule') }}/${schedule.id}`,
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
                    success: function (res) {
                        iziToast.success({
                            title: 'Success',
                            message: res.message,
                            position: 'topRight'
                        });
                    },
                    error: function (res) {
                        const message = res.responseJSON.message
                        info.revert()
                        iziToast.error({
                            title: 'Error',
                            message: message ?? 'Something wrong',
                            position: 'topRight'
                        });
                    }
                })
            },
            eventResize: function (info) {
                const {event} = info
                $.ajax({
                    url: `{{ url('schedule') }}/${event.id}`,
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
                    success: function (res) {
                        iziToast.success({
                            title: 'Success',
                            message: res.message,
                            position: 'topRight'
                        });
                    },
                    error: function (res) {
                        const message = res.responseJSON.message
                        info.revert()
                        iziToast.error({
                            title: 'Error',
                            message: message ?? 'Something wrong',
                            position: 'topRight'
                        });
                    }
                })
            }


            });
            calendar.render();
        });

    </script>
  <script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementById("tanggal").setAttribute('min', today);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
  @stack('scripts')
</body>
</html> 