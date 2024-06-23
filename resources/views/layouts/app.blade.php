<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Penjadwalan Shift Kerja Operator</title>
    <!-- <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"> -->
    <!-- <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'> -->
    <link rel="shortcut icon" href="{{ asset('assets/compiled/svg/favicon.svg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/iconly.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/extensions/flatpickr/flatpickr.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css"
        integrity="sha512-O03ntXoVqaGUTAeAmvQ2YSzkCvclZEcPQu1eqloPaHfJ5RuNGiS4l+3duaidD801P50J28EHyonCV06CUlTSag=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    @livewireStyles
</head>

<body>
    <script src="{{ asset('assets/static/js/initTheme.js') }}"></script>
    <!-- header -->
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="theme-toggle d-flex gap-2 align-items-center mt-2 logo">
                            <h1>Shift</h1>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20"
                                height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21">
                                <g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2"
                                        opacity=".3"></path>
                                    <g transform="translate(-210 -1)">
                                        <path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path>
                                        <circle cx="220.5" cy="11.5" r="4"></circle>
                                        <path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                            <div class="form-check form-switch fs-6">
                                <input class="form-check-input  me-0" type="checkbox" id="toggle-dark"
                                    style="cursor: pointer">
                                <label class="form-check-label"></label>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                aria-hidden="true" role="img" class="iconify iconify--mdi" width="20" height="20"
                                preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="m17.75 4.09l-2.53 1.94l.91 3.06l-2.63-1.81l-2.63 1.81l.91-3.06l-2.53-1.94L12.44 4l1.06-3l1.06 3l3.19.09m3.5 6.91l-1.64 1.25l.59 1.98l-1.7-1.17l-1.7 1.17l.59-1.98L15.75 11l2.06-.05L18.5 9l.69 1.95l2.06.05m-2.28 4.95c.83-.08 1.72 1.1 1.19 1.85c-.32.45-.66.87-1.08 1.27C15.17 23 8.84 23 4.94 19.07c-3.91-3.9-3.91-10.24 0-14.14c.4-.4.82-.76 1.27-1.08c.75-.53 1.93.36 1.85 1.19c-.27 2.86.69 5.83 2.89 8.02a9.96 9.96 0 0 0 8.02 2.89m-1.64 2.02a12.08 12.08 0 0 1-7.8-3.47c-2.17-2.19-3.33-5-3.49-7.82c-2.81 3.14-2.7 7.96.31 10.98c3.02 3.01 7.84 3.12 10.98.31Z">
                                </path>
                            </svg>
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        @if (Auth::check())
                            @php
                                $role = Auth::user()->role;
                            @endphp
                            @if ($role === 'admin')
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.dashboard.index') }}" class='sidebar-link'>
                                        <i class="bi bi-grid-fill"></i>
                                        <span>Dasbor Admin</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.schedule.index') }}" class='sidebar-link'>
                                        <i class="bi bi-calendar4-week"></i>
                                        <span>Jadwal</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.shift.index') }}" class='sidebar-link'>
                                        <i class="bi bi-shift"></i>
                                        <span>Shift</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.operator.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Operator</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.supervisor.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person"></i>
                                        <span>Supervisor</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.company.index') }}" class='sidebar-link'>
                                        <i class="bi bi-building-fill"></i>
                                        <span>Perusahaan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.department.index') }}" class='sidebar-link'>
                                        <i class="bi bi-list-nested"></i>
                                        <span>Departemen</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.operator_type.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people"></i>
                                        <span>Jenis Operator</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.report.index') }}" class='sidebar-link'>
                                        <i class="bi bi-book"></i>
                                        <span>Laporan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('admin.profile.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person-fill"></i>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <form id="logout" action="{{ route('logout') }}" method="POST">
                                        <a role="button" class='sidebar-link'
                                        onclick="document.getElementById('logout').submit();"><i class="bi bi-power"></i>
                                        <span>Logout</span></a>
                                        @csrf
                                    </form>
                                </li>
                                @elseif ($role === 'operator')
                                <li class="sidebar-item  ">
                                    <a href="{{ route('operator.schedule.index') }}" class='sidebar-link'>
                                        <i class="bi bi-calendar4-week"></i>
                                        <span>Jadwal</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('operator.supervisor.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people"></i>
                                        <span>Supervisor</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('operator.profile.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person-fill"></i>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <form id="logout" action="{{ route('logout') }}" method="POST">
                                        <a role="button" class='sidebar-link'
                                        onclick="document.getElementById('logout').submit();"><i class="bi bi-power"></i>
                                        <span>Logout</span></a>
                                        @csrf
                                    </form>
                                </li>
                                @elseif ($role === 'supervisor')
                                <li class="sidebar-item  ">
                                    <a href="{{ route('supervisor.schedule.index') }}" class='sidebar-link'>
                                        <i class="bi bi-calendar4-week"></i>
                                        <span>Jadwal</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('supervisor.operator.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Operator</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('supervisor.report.index') }}" class='sidebar-link'>
                                        <i class="bi bi-book"></i>
                                        <span>Laporan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('supervisor.profile.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person"></i>
                                        <span>Profil</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <form id="logout" action="{{ route('logout') }}" method="POST">
                                        <a role="button" class='sidebar-link'
                                        onclick="document.getElementById('logout').submit();"><i class="bi bi-power"></i>
                                        <span>Logout</span></a>
                                        @csrf
                                    </form>
                                </li>
                                @elseif ($role === 'superadmin')
                                <li class="sidebar-item  ">
                                <a href="{{ route('superadmin.shift.index') }}" class='sidebar-link'>
                                    <i class="bi bi-grid-fill"></i>
                                    <span>Dasbor Superadmin</span>
                                </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.schedule.index') }}" class='sidebar-link'>
                                        <i class="bi bi-calendar4-week"></i>
                                        <span>Jadwal</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.shift.index') }}" class='sidebar-link'>
                                        <i class="bi bi-shift"></i>
                                        <span>Shift</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.operator.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people-fill"></i>
                                        <span>Operator</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.supervisor.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person"></i>
                                        <span>Supervisor</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.company.index') }}" class='sidebar-link'>
                                        <i class="bi bi-building-fill"></i>
                                        <span>Perusahaan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.department.index') }}" class='sidebar-link'>
                                        <i class="bi bi-list-nested"></i>
                                        <span>Departemen</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.company_admin.index') }}" class='sidebar-link'>
                                        <i class="bi bi-person-workspace"></i>
                                        <span>Admin Perusahaan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.operator_type.index') }}" class='sidebar-link'>
                                        <i class="bi bi-people"></i>
                                        <span>Jenis Operator</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <a href="{{ route('superadmin.department.index') }}" class='sidebar-link'>
                                        <i class="bi bi-book"></i>
                                        <span>Laporan</span>
                                    </a>
                                </li>
                                <li class="sidebar-item  ">
                                    <form id="logout" action="{{ route('logout') }}" method="POST">
                                        <a role="button" class='sidebar-link'
                                        onclick="document.getElementById('logout').submit();"><i class="bi bi-power"></i>
                                        <span>Logout</span></a>
                                        @csrf
                                    </form>
                                </li>     
                            @endif
                        @else
                        <li class="sidebar-item  ">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-warning"></i>
                                <span>Unauthenticated</span>
                            </a>
                        </li> 
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-8 col-md-10 order-md-1 order-last mb-3">
                            <h3 class="text-muted">Penjadwalan Shift Kerja Operator</h3>
                            <h5>{{ ucwords($role) }} - {{ Auth::user()->company->company_name ?? '' }} - {{ Auth::user()->department->department_name ?? '' }}</h5>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menyimpan perubahan ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="cancelButton" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" id="confirmButton">Ya</button>
                    </div>
                    </div>
                </div>
                </div>

                <section class="section">
                    @yield('content')
                </section>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"
    integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
    integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@hasSection('inline-script')
    @yield('inline-script')
@endif
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<!-- Need: Apexcharts -->
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>


<script src="{{ asset('assets/static/js/components/dark.js') }}"></script>
<script src="{{ asset('assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/compiled/js/app.js') }}"></script>
<script src="{{ asset('assets/extensions/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/dashboard.js') }}"></script>
        
<script src="{{ asset('assets/extensions/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('assets/static/js/pages/date-picker.js') }}"></script>

@stack('scripts')
</body>

</html>
