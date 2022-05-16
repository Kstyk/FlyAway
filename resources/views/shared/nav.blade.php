<div id="menu">
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('trips.index') }}">FlyAway</a>
      </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a class="whitehover" href="#">O nas</a><span class="hover"></span></li>
        <li><a class="whitehover" href="#">Kontakt</a><span class="hover"></span></li>
        @if (Auth::check())
        <li class="nav-item">
            <a class="nav-link whitehover" href="{{ route('logout') }}"> {{ Auth::user()->imie }},
            wyloguj się... </a>
        </li>
        @if(Auth::user()->isAdmin())
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Panel Zarządzania
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('trips.index') }}">Wycieczki</a><br>
                <a class="dropdown-item" href="{{ route('countries.index') }}">Kraje</a><br>
                <a class="dropdown-item" href="#">Loty</a><br>
                <a class="dropdown-item" href="{{ route('airports.index') }}">Lotniska</a><br>
                <a class="dropdown-item" href="#">Użytkownicy</a><br>
              </div>
          </li>
        @else
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Moje konto
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Moje dane</a>
              <a class="dropdown-item" href="#">Moje loty</a>
            </div>
          </li>
        @endif
        @else
        <li><a href="{{ route('login') }}">Zaloguj się...</a><span class="hover"></span></li>
        <li><a href="#">Zarejestruj się...</a><span class="hover"></span></li>
        @endif
      </ul>
    </div>
    </div>
  </nav>
</div>
