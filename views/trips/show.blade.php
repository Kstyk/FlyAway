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
                        class="img img-fluid">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $trip->nazwa }}
                        </div>
                    </div>
                    <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col"></th>
                            <th scope="col">Informacja</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <th scope="row">1</th>
                            <td>Opis wycieczki</td>
                            <td class="opis">{{ $trip->opis }}</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Kraj</td>
                            <td>{{ $trip->Country->nazwa }}<br>(więcej informacji o kraju <a href="{{ route('countries.show', $trip->Country) }}">tutaj</a>)</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Kontynent</td>
                            <td>{{ $trip->kontynent }}</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Okres trwania wycieczki</td>
                            <td>{{ $trip->okres_trwania }} dni</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Cena wycieczki</td>
                            <td>{{ $trip->cena }} PLN</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    @include('shared.js')
</body>
</html>
