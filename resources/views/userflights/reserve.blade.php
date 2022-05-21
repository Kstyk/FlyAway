<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>

<body>
    @include('shared.nav')
    <div class="container pt-5">
        <h2 class="fw-bold mb-2 text-uppercase text-white text-center">Wybrałeś wycieczkę do: {{ $trip->name }}</h2>
        <h4 class="fw-bold mb-2 text-uppercase text-white text-center">Oto dostępne loty: </h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

            <div class="form-outline form-white mb-4">
                <table class="table text-white">
                    <tr>
                        <th>Nazwa linii</th>
                        <th>Data wylotu</th>
                        <th>Lotnisko startowe</th>
                        <th>Lotnisko końcowe</th>
                        <th>Wolnych miejsc</th>
                        @if(auth()->user()->isAdmin())
                        <th>Użytkownik</th>
                        @endif
                        <th>Wybierz</th>
                    </tr>
                    @forelse ($flights as $f)
                        <tr>
                            <td>{{ $f->airline_name }}</td>
                            <td>{{ $f->departure_date }}</td>
                            <td>{{ $f->airport->name }}, {{ $f->airport->city }}</td>
                            <td>{{ $f->airport2->name }}, {{ $f->airport2->city }}</td>
                            <td>{{ $f->places }}</td>
                            @if(auth()->user()->isAdmin())
                            <form method="POST" action="{{ route('userflight.store') }}">
                                @csrf
                                @method('POST')
                            <td>
                                <select name="user_id" id="user" class ="form-control bg-dark text-white">
                                    @foreach ($users as $u)
                                        <option class="px-2" value="{{ $u->id }}">{{ $u->name }} {{ $u->surname }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input name="flight_id" type="text" class="d-none" value="{{ $f->id }}">
                                <button class="btn btn-outline-light btn-lg px-2" type="submit">Rezerwuj</button>
                            </td>
                            </form>
                            @else
                            <td>
                                <form method="POST" action="{{ route('userflight.store') }}">
                                    @csrf
                                    @method('POST')
                                    <input name="flight_id" type="text" class="d-none" value="{{ $f->id }}">
                                    <input name="user_id" type="text" class="d-none" value="{{ Auth::user()->id }}">
                                    <button class="btn btn-outline-light btn-lg px-2" type="submit">Rezerwuj</button>
                                </form>
                            </td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Nie ma obecnie żadnych lotów do {{ $trip->name }}</td>
                        </tr>
                    @endforelse
                </table>
            </div>
    </div>
    @include('shared.js')
</body>

</html>
