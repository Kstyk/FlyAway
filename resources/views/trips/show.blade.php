<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szczegóły tripa</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/show_card.css')}}">
<body>
    @include('shared.nav')
    <div class="container" id="container_trips">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-card-4 text-center"><img src="{{ asset('storage\img_trips\p'.$trip->id.'.jpg') }}"
                        class="img img-responsive">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $trip->nazwa }}
                        </div>
                    </div>
                    <table id="tabela_wycieczki">
                        <th>
                            <td>Informacje</td>
                        </th>
                        <tr>
                            <td>Opis</td>
                            <td>{{ $trip->opis }}</td>
                        </tr>
                        <tr>
                            <td>Kontynent</td>
                            <td>{{ $trip->kontynent }}</td>
                        </tr>
                        <tr>
                            <td>Kraj</td>
                            <td>{{ $trip->Country->nazwa }}</td>
                        </tr>
                        <tr>
                            <td>Czas trwania wycieczki</td>
                            <td>{{ $trip->okres_trwania }}</td>
                        </tr>
                        <tr>
                            <td>Cena wycieczki</td>
                            <td>{{ $trip->cena }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('shared.js')
</body>
</html>
