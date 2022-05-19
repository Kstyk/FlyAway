<!DOCTYPE html>
<html lang="en">
<head>
    @include('shared.header')
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

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj lotnisko</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('airports.update', $airport->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <input id="nazwa" type="text" name="nazwa" value="{{ $airport->nazwa }}" class="form-control form-control-lg
                        @error('nazwa') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="nazwa">Nazwa</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="country_id" name="country_id">
                            @foreach ($countries as $c)
                                <option value="{{$c->id}}" @if($c->nazwa == $airport->country->nazwa) selected @endif>
                                    {{ $c->nazwa }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="country_id">Kraj</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="miasto" type="text" id="miasto" value="{{ $airport->miasto }}" class="form-control form-control-lg
                        @error('miasto') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="miasto">Miasto</label>
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

