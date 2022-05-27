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
        @include('shared.error')

            <div class="form-outline form-white mb-4">
                <table class="table text-white">
                    <tr>
                        <th>Nazwa linii</th>
                        <th>Data wylotu</th>
                        <th>Lotnisko startowe</th>
                        <th>Lotnisko końcowe</th>
                        <th>Wolnych miejsc</th>
                        <th>Cena za bilet</th>
                        <th>Liczba biletów</th>
                        <th>Wybierz</th>
                    </tr>
                    @forelse ($flights as $f)
                        <tr>
                            <td>{{ $f->airline_name }}</td>
                            <td>{{ $f->departure_date }}</td>
                            <td>{{ $f->departure->name }}, {{ $f->departure->city }}</td>
                            <td>{{ $f->destination->name }}, {{ $f->destination->city }}</td>
                            <td>{{ $f->places }}</td>
                            <td>{{ $f->Trip->price }}</td>
                            <form method="POST" action="{{ route('userflight.addToCart', ['id' => $f->id]) }}">
                                @csrf
                                @method('POST')
                            <td>
                                <select name="amount_of_tickets" id="amount_of_tickets" class ="form-control bg-dark text-white">
                                    @for ($i = 1; $i <= $f->places; $i++)
                                        <option class="px-2" value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                    <input name="flight_id" type="text" class="d-none" value="{{ $f->id }}">
                                    <input name="user_id" type="text" class="d-none" value="{{ Auth::user()->id }}">
                                    <button class="btn btn-outline-light btn-lg px-2" type="submit">Dodaj do koszyka</button>
                            </td>
                            </form>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Nie ma obecnie żadnych lotów do {{ $trip->name }}</td>
                        </tr>
                    @endforelse
                </table>
            </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>

</html>
