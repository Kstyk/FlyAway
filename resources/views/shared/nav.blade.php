<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid pt-0">
      <a class="navbar-brand" href="{{ route('trips.index') }}">FlyAway</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="nav navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">O nas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Kontakt</a>
          </li>
        </ul>
        <ul class="nav navbar-nav">
          @if (Auth::check())
          @if(Auth::user()->isAdmin())
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Panel Zarządzania
            </a>
            <ul class="dropdown-menu bg-dark" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('trips.index') }}">Wycieczki</a></li>
              <li><a class="dropdown-item" href="{{ route('countries.index') }}">Kraje</a></li>
              <li><a class="dropdown-item" href="{{ route('flights.index') }}">Loty</a></li>
              <li><a class="dropdown-item" href="{{ route('airports.index') }}">Lotniska</a></li>
              <li><a class="dropdown-item" href="{{ route('userflights.index') }}">Zarezerwowane loty</a></li>
              <li><a class="dropdown-item" href="#">Użytkownicy</a></li>
            </ul>
          </li>
          @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Moje konto
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="{{ route('users.show', Auth::user()->id) }}">Moje dane</a></li>
              <li><a class="dropdown-item" href="{{ route('userflights.index') }}">Moje loty</a></li>
            </ul>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link whitehover" href="{{ route('logout') }}"> {{ Auth::user()->name }},
            wyloguj się... </a>
            </li>
          @else
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Zaloguj się...</a><span class="hover"></span></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Zarejestruj się...</a><span class="hover"></span></li>
          @endif
        </ul>
    </div>
  </nav>
