<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil {{ Auth::user()->imie }} {{ Auth::user()->nazwisko }}</title>
    <link rel="stylesheet" href="{{ asset('css/user_info.css') }}">
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    @include('shared.header')
</head>

<body>
    @include('shared.nav')

    <div class="container">
    <div class="row py-5 px-8">
        <div class="col-md-8 mx-auto">
            <!-- Profile widget -->
            <div class="shadow rounded overflow-hidden">
                <div class="px-4 pt-0 pb-4 cover border border-bottom-0 border-white">
                    <div class="media profile-head pb-5 d-flex flex-row justify-content-around">
                        <div class="profile mr-3 pb-5">
                            <img src="{{ asset('storage\avatars\default.png') }}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                        </div>

                        <div class="media-body mb-5 text-white pb-10 justify-content-end">
                            <h4 class="mt-0 mb-0">{{ $user->imie }} {{ $user->nazwisko }}</h4>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-dark btn-sm btn-block p-2 text-white mt-2">Edytuj profil</a>
                        </div>

                    </div>
                </div>
            <div class="d-flex flex-row justify-content-center bg-transparent border border-white">
                <table class="table text-white text-center">
                    <tbody>
                      <tr>
                        <th>Imię</th>
                        <td>{{ $user->imie }}</td>
                      </tr>
                      <tr>
                        <th>Nazwisko</th>
                        <td>{{ $user->nazwisko }}</td>
                      </tr>
                      <tr>
                        <th>Rok urodzenia</th>
                        <td>{{ $user->rok_urodzenia }}</td>
                      </tr>
                      <tr>
                          <th>Email</th>
                          <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                          <th colspan="2"><a href="#">Zmień hasło</a></th>
                      </tr>
                    </tbody>
                  </table>
            </div>
            </div>
        </div>
    </div>
    </div>

    @include('shared.js')
    </body>

</html>