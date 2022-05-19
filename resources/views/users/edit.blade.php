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
</head>
<body>
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-dark text-white" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj użytkownika</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="imie" type="text" name="imie" value="{{ $user->imie }}" class="form-control form-control-lg
                        @error('imie') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="imie">Imię</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="nazwisko" type="text" id="nazwisko" value="{{ $user->nazwisko }}" class="form-control form-control-lg
                        @error('nazwisko') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="nazwisko">Nazwisko</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="rok_urodzenia" type="number" id="rok_urodzenia" value="{{ $user->rok_urodzenia }}" class="form-control form-control-lg
                        @error('rok_urodzenia') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="rok_urodzenia">Rok urodzenia</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="email" type="email" id="email" value="{{ $user->email }}" class="form-control form-control-lg
                        @error('email') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="email">Email</label>
                    </div>
                    <button class="btn btn-outline-light btn-lg px-5" type="submit">Edytuj</button>
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

