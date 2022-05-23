<!DOCTYPE html>
<html lang="en">

<head>
    <title>Loty</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <style>
        table {
            color:white;
        }
        table td a {
            text-decoration: none;
        }

        table td a:hover {
            text-decoration: underline;
        }

        #btn:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    @include('shared.nav')
    <div class="container container-fluid">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Loty</h1>
        @if ($errors->any())
            <h4><?php echo "<script type='text/javascript'>alert('" . $errors->first() . "');</script>"; ?></h4>
        @endif
        @can('create', $flights->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('flights.create') }}">
                <span>Dodaj lot</span>
            </a>
        </div>
        @endcan
        <div class="container-fluid pt-0">
        <table class="table text-white">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Wycieczka</th>
                <th scope="col">Nazwa linii</th>
                <th scope="col">Liczba miejsc</th>
                <th scope="col">Lotnisko startowe</th>
                <th scope="col">Lotnisko końcowe</th>
                <th scope="col">Data wylotu</th>
                @can('update', $flights->first())
                <th scope="col">Edytuj</th>
                <th scope="col">Usuń</th>
                @endcan
              </tr>
              <?php $i = 1; ?>
              @forelse ($flights as $f)
                <tr>
                    <td><?php echo $i; $i++; ?></td>
                    <td><a href="{{ route('trips.show', $f->trip->id) }}">{{ $f->Trip->name }}</a></td>
                    <td>{{ $f->airline_name }}</td>
                    <td>{{ $f->places }}</td>
                    <td><a href="{{ route('airports.show', $f->Airport->id) }}">{{ $f->Airport->name }}</a></td>
                    <td><a href="{{ route('airports.show', $f->Airport2->id) }}">{{ $f->Airport2->name }}</a></td>
                    <td>{{ $f->departure_date }}</td>
                    @can('update', $f)
                    <td><a href="{{ route('flights.edit', $f) }}">Edycja</a></td>
                    <td><form id="delete" method="POST" action="{{ route('flights.destroy', $f->id) }}">
                        @csrf
                        @method('DELETE')
                        <button id="btn" type="submit" onclick="return confirm('Jesteś pewien, że chcesz usunąć ten lot?')">Usuń</button>
                    </form></td>
                    @endcan
                </tr>
                @empty
              @endforelse
            </thead>
          </table>
        </div>
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5 mt-5">Odbyte loty</h1>
        <div class="container-fluid pt-0">
            <table class="table table-responsive text-white">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Wycieczka</th>
                    <th scope="col">Nazwa linii</th>
                    <th scope="col">Wolne miejsca</th>
                    <th scope="col">Lotnisko startowe</th>
                    <th scope="col">Lotnisko końcowe</th>
                    <th scope="col">Data wylotu</th>
                    @can('update', $flights->first())
                    <th scope="col">Edytuj</th>
                    <th scope="col">Usuń</th>
                    @endcan
                  </tr>
                  <?php $i = 1; ?>
                  @forelse ($flights_arch as $f)
                    <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><a href="{{ route('trips.show', $f->Trip->id) }}">{{ $f->Trip->name }}</a></td>
                        <td>{{ $f->airline_name }}</td>
                        <td>{{ $f->places }}</td>
                        <td><a href="{{ route('airports.show', $f->Airport->id) }}">{{ $f->Airport->name }}</a></td>
                        <td><a href="{{ route('airports.show', $f->Airport2->id) }}">{{ $f->Airport2->name }}</a></td>
                        <td>{{ $f->departure_date }}</td>
                        @can('update', $f)
                        <td><a href="{{ route('flights.edit', $f) }}">Edycja</a></td>
                        <td><form id="delete" method="POST" action="{{ route('flights.destroy', $f->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Jesteś pewien, że chcesz usunąć ten lot?')"><span class="span">Usuń</span></button>
                        </form></td>
                        @endcan
                    </tr>
                    @empty
                  @endforelse
                </thead>
              </table>
            </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>

</html>
