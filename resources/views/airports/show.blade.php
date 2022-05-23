<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szczegóły lotniska</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/show_card.css')}}">
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
<body>
    @include('shared.nav')
    <div class="container container-fluid">
        <h1 class="fw-bold mb-2 text-uppercase text-white text-center border-bottom border-white pb-1 mb-5">{{ $airport->name }}</h1>
        <div class="row">
            <div class="col-md-12">
                <div class="profile-card-4 text-center">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $airport->name }}
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
                            <td>Kraj</td>
                            <td>{{ $airport->Country->name }}</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Miasto</td>
                            <td>{{ $airport->city }}</td>
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
