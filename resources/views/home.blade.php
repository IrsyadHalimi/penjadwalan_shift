<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  Ini Return Penolakan Akses
  @guest
                            <a class="nav-link active" href="{{ route('login') }}">Login</a>
                            <a class="nav-link active" href="{{ route('register') }}">Register</a>
                            @else
                            <form id="logout" action="{{ route('logout') }}" method="POST">
                                <a role="button" class="nav-link active"
                                onclick="document.getElementById('logout').submit();">Logout</a>
                                @csrf
                            </form>
                            @endguest
</body>
</html>