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
    @include('shared.error')
    @if (Session::has('cart'))
        <div class="container container-fluid">
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
                            <td><button class="btn btn-success w-50">-1</button></td>
                            <td><button class="btn btn-success w-50">Wszystkie</button></td>
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
                    <input type="text" name="user_id" class="d-none" value={{ Auth::user()->id }}>
                    <button type="submit" class="btn">Kup</button>
                </form>
            </div>
        @else
            <div class="row">
                <strong class="text-white text-center">Koszyk jest pusty</strong>
            </div>
    @endif
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>

</html>
