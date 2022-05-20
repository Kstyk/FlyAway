<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Użytkownicy</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>
<body>
    @include('shared.nav')
    <div class="container container-fluid">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Użytkownicy</h1>
        @if ($errors->any())
            <h4><?php echo "<script type='text/javascript'>alert('" . $errors->first() . "');</script>"; ?></h4>
        @endif
        <table class="table text-white">
            <thead>
              <tr>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Rok urodzenia</th>
                <th scope="col">Email</th>
                <th scope="col">Kraj</th>
                <th scope="col">Edytuj</th>
                <th scope="col">Usuń</th>
              </tr>
              @forelse ($users as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->surname }}</td>
                    <td>{{ $u->date_of_birth }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->Country->name }}</td>
                    <td><a class="btn btn-outline-light btn-lg px-2 py-1 border border-white" href="{{ route('users.edit', $u->id) }}">Edycja</a></td>
                    <td><form id="delete" method="POST" action="{{ route('users.destroy', $u->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-light btn-lg px-2 py-1 border border-white" onclick="return confirm('Jesteś pewien, że chcesz usunąć tego użytkownika?')">Usuń</button>
                    </form></td>
                </tr>
                @empty
              @endforelse
            </thead>
          </table>
    </div>
    @include('shared.js')
</body>
</html>
