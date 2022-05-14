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
        <li><a href="#">O nas</a><span class="hover"></span></li>
        <li><a href="#">Kontakt</a><span class="hover"></span></li>
        @if (Auth::check())
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"> {{ Auth::user()->imie }},
            wyloguj się... </a>
            </li>
        @else
        <li><a href="{{ route('login') }}">Zaloguj się...</a><span class="hover"></span></li>
        <li><a href="#">Zarejestruj się...</a><span class="hover"></span></li>
        @endif
      </ul>
    </div>
    </div>
  </nav>
</div>
