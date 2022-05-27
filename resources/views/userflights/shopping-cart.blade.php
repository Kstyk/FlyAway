<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Twój koszyk</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>

<body>
    @include('shared.nav')
    @if(Session::has('cart'))
    @if (Session::get('cart')->items != null)
        <div class="container container-fluid">
            @include('shared.error')
            <div class="row">
                <table class="table text-white text-center">
                    <tr>
                        <th>Ilość biletów</th>
                        <th>Nazwa wycieczki</th>
                        <th>Łączna cena</th>
                        <th>Usuń jeden bilet</th>
                        <th>Usuń wszystkie</th>
                    </th>
                    @foreach ($flights as $f)
                        <tr>
                            <td><span class="badge">{{ $f['qty'] }}</span></td>
                            <td><span>{{ $f['flight']['trip']['name'] }}</span></td>
                            <td><span>{{ $f['price'] }}</span></td>
                            <td>
                                <form method="GET" action="{{ route('userflight.deleteOne', $f['flight']['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-success w-50" type="submit">-1</button>
                                </form>
                            </td>
                            <td>
                                <form method="GET" action="{{ route('userflight.delete', $f['flight']['id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-success w-50" type="submit">Wszystkie</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </table>
            </div>
            <div class="row" style="border-top:1px solid white;">
                <span class="text-white fw-bold">Razem do zapłaty: {{ $totalPrice }} PLN</span>
            </div>
            <hr>
            <div class="row">
                <form action="{{ route('userflight.store') }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn">Kup</button>
                </form>
                <form action="{{ route('userflight.deleteAll') }}" method="post">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn">Wyczyść cały koszyk</button>
                </form>
            </div>
        @else
            <h2 class="fw-bold mb-2 text-uppercase text-white text-center mt-5">Koszyk jest pusty</h2>
        @endif
        @else
            <h2 class="fw-bold mb-2 text-uppercase text-white text-center mt-5">Koszyk jest pusty</h2>
    @endif
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>

</html>
