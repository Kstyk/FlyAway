<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $trip->name }}</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/show_card.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
<body>
    @include('shared.nav')
    <div class="container" id="container_trips">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">{{ $trip->name }}</h1>
        @include('shared.error')

        <div class="row">
            <div class="col-md-12">
                <div class="profile-card-4 text-center"><img src="{{ asset('storage\img_trips\\'.$trip->img_name.'') }}"
                        class="img img-fluid">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $trip->name }}
                        </div>
                    </div>
                    <table class="table">
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
                            <td class="opis">{{ $trip->describe }}</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Kraj</td>
                            <td>{{ $trip->Country->name }}<br>(więcej informacji o kraju <a href="{{ route('countries.show', $trip->Country) }}">tutaj</a>)</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Kontynent</td>
                            <td>{{ $trip->continent }}</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Okres trwania wycieczki</td>
                            <td>{{ $trip->period }} dni</td>
                          </tr>
                          <tr>
                            <th scope="row">5</th>
                            <td>Cena wycieczki</td>
                            <td>{{ $trip->price }} PLN</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
</body>
</html>
