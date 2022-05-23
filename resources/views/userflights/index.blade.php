<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zarezerwowane loty</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <link rel="stylesheet" href="{{asset('css/table_userflights.css')}}">
    <style>
        table a:hover {
            text-decoration: underline !important;
        }
    </style>
</head>
<body>
    @include('shared.nav')
    <div class="container pt-5">
        <h4 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Zarezerwowane loty: </h4>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

                <table class="table text-white" id="sortedTable">
                    <tr>
                        <th>Imię i nazwisko</th>
                        <th>Wycieczka</th>
                        <th>Nazwa linii</th>
                        <th>Lotnisko startowe</th>
                        <th>Lotnisko końcowe</th>
                        <th>Data wylotu</th>
                        <th>Data zakupu</th>
                        <th style="width: 5%">Liczba zarezerwowanych biletów</th>
                        <th>Usuń rezerwację</th>
                    </tr>
                    @foreach ($uf as $f)
                        @if($f->Flight->departure_date > \Carbon\Carbon::now())
                        <tr>
                            <td>{{ $f->User->name }} {{ $f->User->surname }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('trips.show', $f->Flight->Trip->id) }}">{{ $f->Flight->Trip->name }}</a></td>
                            <td>{{ $f->Flight->airline_name }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport->id) }}">{{ $f->Flight->airport->name }}, {{ $f->Flight->airport->city }}</a></td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport2->id) }}">{{ $f->Flight->airport2->name }}, {{ $f->Flight->airport2->city }}</a></td>
                            <td>{{ $f->Flight->departure_date }}</td>
                            <td>{{ $f->date_of_purchase }}</td>
                            <td>{{ $f->amount_of_tickets }}</td>
                            <td ><form class="d-flex flex-column align-content-center" id="delete" method="POST" action="{{ route('userflights.destroy', $f->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-light btn-lg px-5 py-3 border border-white" type="submit"
                                @if(!auth()->user()->isAdmin())
                                    onclick="return confirm('Jesteś pewien, że chcesz odwołać tą rezerwację? Odzyskasz tylko połowę pieniędzy!')">Odwołaj
                                @else
                                    onclick="return confirm('Jesteś pewien, że chcesz odwołać tą rezerwację? Ten użytkownik odzyska tylko połowę pieniędzy!')">Odwołaj
                                @endif
                            </button>
                            </form></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
                <br><br>
                <h4 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">Odbyte loty: </h4>
                <table class="table text-white">
                    <tr>
                        <th>Imię i nazwisko</th>
                        <th>Wycieczka</th>
                        <th>Nazwa linii</th>
                        <th>Lotnisko startowe</th>
                        <th>Lotnisko końcowe</th>
                        <th>Data wylotu</th>
                        <th>Data zakupu</th>
                        <th style="width: 5%">Liczba zarezerwowanych biletów</th>
                        <th>Usuń rezerwację</th>
                    </tr>
                    @foreach ($uf as $f)
                        @if($f->Flight->departure_date < \Carbon\Carbon::now())
                        <tr>
                            <td>{{ $f->User->name }} {{ $f->User->surname }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('trips.show', $f->Flight->Trip->id) }}">{{ $f->Flight->Trip->name }}</a></td>
                            <td>{{ $f->Flight->airline_name }}</td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport->id) }}">{{ $f->Flight->airport->name }}, {{ $f->Flight->airport->city }}</a></td>
                            <td><a class="text-white text-decoration-none" href="{{ route('airports.show', $f->Flight->airport2->id) }}">{{ $f->Flight->airport2->name }}, {{ $f->Flight->airport2->city }}</a></td>
                            <td>{{ $f->Flight->departure_date }}</td>
                            <td>{{ $f->date_of_purchase }}</td>
                            <td>{{ $f->amount_of_tickets }}</td>
                            <td><form id="delete" method="POST" action="{{ route('userflights.destroy', $f->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-light btn-lg px-5 py-2 border border-white" type="submit" onclick="return confirm('Jesteś pewien, że chcesz usunąć ten lot?')">Usuń ten lot</button>
                            </form></td>
                        </tr>
                        @endif
                    @endforeach
                </table>
    </div>
    @include('shared.footer')
    @include('shared.js')
    <script>
        $(document).ready(function() {
            $('#sortedTable').DataTable();
        });
    </script>
</body>
</html>
