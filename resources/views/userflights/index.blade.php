<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zarezerwowane loty</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <style>
        table a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body>
    @include('shared.nav')
    <div class="container pt-5">
        <h4 class="fw-bold mb-2 text-uppercase text-white text-center">Zarezerwowane loty: </h4>
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
                        <th>Imię i nazwisko</th>
                        <th>Wycieczka</th>
                        <th>Nazwa linii</th>
                        <th>Lotnisko startowe</th>
                        <th>Lotnisko końcowe</th>
                        <th>Data wylotu</th>
                        <th>Data zakupu</th>
                    </tr>
                    @foreach ($uf as $f)
                        <tr>
                            <td>{{ $f->User->name }} {{ $f->User->surname }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('trips.show', $f->Flight->Trip->id) }}">{{ $f->Flight->Trip->name }}</a></td>
                            <td>{{ $f->Flight->airline_name }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport->id) }}">{{ $f->Flight->airport->name }}, {{ $f->Flight->airport->city }}</a></td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport2->id) }}">{{ $f->Flight->airport2->name }}, {{ $f->Flight->airport2->city }}</a></td>
                            <td>{{ $f->Flight->departure_date }}</td>
                            <td>{{ $f->date_of_purchase }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
    </div>
    @include('shared.js')
</body>
</html>
