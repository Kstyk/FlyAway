<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Szczegóły kraju</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/show_card.css')}}">
<body>
    @include('shared.nav')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-card-4 text-center">
                    <div class="profile-content">
                        <div class="profile-name">
                            {{ $c->nazwa }}
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
                            <td>Nazwa</td>
                            <td class="opis">{{ $c->nazwa }}</td>
                          </tr>
                          <tr>
                            <th scope="row">2</th>
                            <td>Kod iso</td>
                            <td>{{ $c->iso3166 }}</td>
                          </tr>
                          <tr>
                            <th scope="row">3</th>
                            <td>Waluta</td>
                            <td>{{ $c->waluta }}</td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Powierzchnia całkowita</td>
                            <td>{{ $c->powierzchnia_calkowita }} km<sup>2</sup></td>
                          </tr>
                          <tr>
                            <th scope="row">4</th>
                            <td>Język urzędowy</td>
                            <td>{{ $c->jezyk_urzedowy }} </td>
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
