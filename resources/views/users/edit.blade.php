<!DOCTYPE html>
<html lang="en">
<head>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
    <style>
        body {
            color:white;
        }
    </style>
    <title>Edytuj użytkownika</title>
</head>
<body>
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-transparent text-white border-0">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj użytkownika</h2>
                  @include('shared.error')
                  <form method="POST" enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="name" type="text" name="name" value="{{ $user->name }}" class="form-control-lg w-100
                        @error('name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="name">Imię</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="surname" type="text" id="surname" value="{{ $user->surname }}" class="form-control-lg w-100
                        @error('surname') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="surname">Nazwisko</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="date_of_birth" type="number" id="date_of_birth" value="{{ $user->date_of_birth }}" class="form-control-lg w-100
                        @error('date_of_birth') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="date_of_birth">Rok urodzenia</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="email" type="email" id="email" value="{{ $user->email }}" class="form-control-lg w-100
                        @error('email') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control-lg w-100" id="country_id" name="country_id">
                            @foreach ($countries as $c)
                                <option value="{{$c->id}}" @if($c->id == $user->country_id) selected @endif>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="country_id">Kraj</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="avatar" type="file" id="avatar" accept="image/png, image/gif, image/jpeg" class="form-control-lg w-100
                        @error('avatar') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="avatar">Avatar użytkownika</label>
                    </div>
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Edytuj</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('shared.footer')
    @include('shared.js')
</body>
</html>

