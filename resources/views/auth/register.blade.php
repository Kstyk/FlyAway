<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rejestracja</title>
    @include('shared.header')
    <link rel="stylesheet" href="{{asset('css/cards_with_trips.css')}}">
</head>
<body class="text-white">
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-transparent text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Zarejestruj się</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    @method('POST')
                    <div class="form-outline form-white mb-4">
                        <input id="name" type="text" name="name" class="form-control form-control-lg
                        @error('name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="name">Imię</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input id="surname" type="text" name="surname" class="form-control form-control-lg
                        @error('surname') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="surname">Nazwisko</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="date_of_birth" type="number" id="date_of_birth" class="form-control form-control-lg
                        @error('date_of_birth') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="date_of_birth">Rok urodzenia</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="email" type="email" id="email" class="form-control form-control-lg
                        @error('email') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="country_id" name="country_id">
                            @foreach ($countries as $c)
                                <option value="{{$c->id}}">
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="country_id">Kraj</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="password" type="password" id="password" class="form-control form-control-lg
                        @error('password') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="password">Hasło</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="confirm_password" type="password" id="confirm_password" class="form-control form-control-lg
                        @error('confirm_password') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="confirm_password">Powtórz hasło</label>
                    </div>

                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Zarejestruj</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    @include('shared.js')
</body>
</html>
