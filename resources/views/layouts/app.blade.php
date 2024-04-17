<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
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
          <a class="nav-link active" href="#">Departemen</a>
          <a class="nav-link active" href="{{ route('admin.jadwal.index') }}">Jadwal Kerja</a>
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
  <script>
  var today = new Date().toISOString().split('T')[0];
  document.getElementById("tanggal").setAttribute('min', today);
</script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="{{ asset('js/bootstrap.js') }}"></script>
</body>
</html> 