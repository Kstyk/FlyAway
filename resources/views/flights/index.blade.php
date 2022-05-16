<!DOCTYPE html>
<html lang="en">

<head>
    <title>Flights</title>
    @include('shared.header')
    <style>
        table {
            color:white;
        }
    </style>
</head>

<body>
    @include('shared.nav')
    <div class="container">
        @if ($errors->any())
            <h4><?php echo "<script type='text/javascript'>alert('" . $errors->first() . "');</script>"; ?></h4>
        @endif
        {{-- @can('create', $countries->first())
        <div class="row">
            <a class="btn btn-lg btn-add" href="{{ route('countries.create') }}">
                <span>Dodaj kraj</span>
            </a>
        </div>
        @endcan --}}

        <table class="table table-dark text-white">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Wycieczka</th>
                <th scope="col">Nazwa linii</th>
                <th scope="col">Liczba miejsc</th>
                <th scope="col">Lotnisko startowe</th>
                <th scope="col">Lotnisko końcowe</th>
                <th scope="col">Data wylotu</th>
                <th scope="col">Edytuj</th>
                <th scope="col">Usuń</th>
              </tr>
              @forelse ($flights as $f)
                <tr>
                    <td>{{ $f->id }}</td>
                    <td>{{ $f->Trip->nazwa }}</td>
                    <td>{{ $f->nazwa_linii }}</td>
                    <td>{{ $f->liczba_miejsc }}</td>
                    <td>{{ $f->Airport->nazwa }}</td>
                    <td>{{ $f->Airport2->nazwa }}</td>
                    <td>{{ $f->data_wylotu }}</td>
                    <td><a href="{{ route('flights.edit', $f) }}">Edycja</a></td>
                    <td>Usuń</td>
                </tr>
                @empty
              @endforelse
            </thead>
            <tbody>

            </tbody>
          </table>
    </div>
    @include('shared.js')
</body>

</html>
