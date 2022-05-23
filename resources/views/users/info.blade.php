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
    <title>Profil {{ $user->name }} {{ $user->surname }}</title>
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
                            <img src="{{ asset('storage\avatars\\'.$user->avatar.'') }}" alt="..." width="130" class="rounded mb-2 img-thumbnail">
                            <input type="text" name="avatar" value="default.png" class="d-none">
                            </div>

                        <div class="media-body mb-5 text-white pb-10 justify-content-end">
                            <h4 class="mt-0 mb-0">{{ $user->name }} {{ $user->surname }}</h4>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-outline-dark btn-sm btn-block p-2 text-white mt-2 border border-white">Edytuj profil</a>
                            @if(!Auth::user()->isAdmin())
                            <a href="{{ route('addmoney', $user->id) }}" class="btn btn-outline-dark btn-sm btn-block p-2 text-white mt-2 border border-white">Doładuj konto</a>
                            @endif
                        </div>

                    </div>
                </div>
            <div class="d-flex flex-row justify-content-center bg-transparent border border-white">
                <table class="table text-white text-center">
                    <tbody>
                      <tr>
                        <th>Imię</th>
                        <td>{{ $user->name }}</td>
                      </tr>
                      <tr>
                        <th>Nazwisko</th>
                        <td>{{ $user->surname }}</td>
                      </tr>
                      <tr>
                        <th>Rok urodzenia</th>
                        <td>{{ $user->date_of_birth }}</td>
                      </tr>
                      <tr>
                          <th>Email</th>
                          <td>{{ $user->email }}</td>
                      </tr>
                      <tr>
                          <th>Stan konta</th>
                          <td>{{ $user->bank_balance}} PLN</td>
                      </tr>
                      <tr>
                        <th>Kraj</th>
                        <td>{{ $user->country->name }}</td>
                        </tr>
                        @if(!Auth::user()->isAdmin())
                      <tr>
                          <th colspan="2"><a class="btn btn-outline-light btn-lg px-5 text-white" href="{{ route('change-password') }}">Zmień hasło</a></th>
                      </tr>
                      @endif
                    </tbody>
                  </table>
            </div>
            </div>
        </div>
    </div>
    </div>
    @include('shared.footer')
    @include('shared.js')
    </body>

</html>
