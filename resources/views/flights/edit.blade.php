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

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj lot</h2>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                  @endif
                  <form method="POST" action="{{ route('flights.update', $flight->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="trip_id" name="trip_id">
                            @foreach ($trips as $t)
                                <option value="{{$t->id}}" @if($t->nazwa == $flight->trip->nazwa) selected @endif>
                                    {{ $t->nazwa }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="trip_id">Wycieczka</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input id="nazwa_linii" type="text" name="nazwa_linii" value="{{ $flight->nazwa_linii }}" class="form-control form-control-lg
                        @error('nazwa_linii') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="nazwa_linii">Nazwa linii</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="liczba_miejsc" type="number" id="liczba_miejsc" value="{{ $flight->liczba_miejsc }}" class="form-control form-control-lg
                        @error('liczba_miejsc') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="liczba_miejsc">Liczba miejsc</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="airport_id" name="airport_id">
                            @foreach ($airports as $a)
                                <option value="{{$a->id}}" @if($a->nazwa == $flight->airport->nazwa) selected @endif>
                                    {{ $a->nazwa }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="airport_id">Lotnisko startowe</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control form-control-lg" id="airport_id_2" name="airport_id_2">
                            @foreach ($airports as $a)
                                <option value="{{$a->id}}" @if($a->nazwa == $flight->airport2->nazwa) selected @endif>
                                    {{ $a->nazwa }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="airport_id_2">Lotnisko końcowe</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="data_wylotu" type="text" class="form-control" value={{ \Carbon\Carbon::parse($a->data_wylotu)->format('Y-m-d') }}>

                        <label class="form-label" for="data_wylotu">Data wylotu</label>
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

