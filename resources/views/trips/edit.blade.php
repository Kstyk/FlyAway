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
    <title>Edytuj wycieczkę</title>
</head>
<body>
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-transparent text-white border-0">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj wycieczkę</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" enctype="multipart/form-data" action="{{ route('trips.update', $trip->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="name" type="text" name="name" value="{{ $trip->name }}" class="form-control form-control-lg
                        @error('name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="name">Nazwa</label>
                    </div>

                    <div class="form-outline form-white mb-4">
                        <input name="continent" type="text" id="continent" value="{{ $trip->continent }}" class="form-control form-control-lg
                        @error('continent') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="continent">Kontynent</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="period" type="number" id="period" value="{{ $trip->period }}" class="form-control form-control-lg
                        @error('period') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="period">Okres trwania wycieczki</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <textarea name="describe" id="describe" rows="5" class="form-control form-control-lg
                        @error('describe') is-invalid @else is-valid
                        @enderror">{{ $trip->describe }}</textarea>
                        <label class="form-label" for="describe">Opis</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="price" type="number" id="price" value="{{ $trip->price }}" class="form-control form-control-lg
                        @error('price') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="price">Cena wycieczki</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="country_id" name="country_id">
                            @foreach ($countries as $c)
                                <option value="{{$c->id}}" @if($c->name == $trip->country->name) selected @endif>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="country_id">Kraj</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="img_name" type="file" id="img_name" accept="image/png, image/gif, image/jpeg" class="form-control form-control-lg
                        @error('img_name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="img_name">Zdjęcie wycieczki</label>
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

