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
    <title>Edytuj lot</title>
</head>
<body>
    @include('shared.nav')

    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-lg-12 col-xl-12">
            <div class="card bg-transparent text-white border-0">
              <div class="card-body p-5 text-center">

                <div class="mb-md-5 mt-md-4 pb-5">

                  <h2 class="fw-bold mb-2 text-uppercase">Edytuj lot</h2>
                  @include('shared.error')

                  <form method="POST" action="{{ route('flights.update', $flight->id) }}">
                    @csrf
                    @method('PUT')
                    <p class="text-white-50 mb-5">Wprowadź poprawne dane</p>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control-lg w-100" id="trip_id" name="trip_id">
                            @foreach ($trips as $t)
                                <option value="{{$t->id}}" @if($t->name == $flight->trip->name) selected @endif>
                                    {{ $t->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="trip_id">Wycieczka</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input id="airline_name" type="text" name="airline_name" value="{{ $flight->airline_name }}" class="form-control-lg w-100
                        @error('airline_name') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="airline_name">Nazwa linii</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <input name="places" type="number" id="places" value="{{ $flight->places }}" class="form-control-lg w-100
                        @error('places') is-invalid @else is-valid
                        @enderror" />
                        <label class="form-label" for="places">Liczba miejsc</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control-lg w-100" id="departure_airport" name="departure_airport">
                            @foreach ($airports as $a)
                                <option value="{{$a->id}}" @if($a->name == $flight->departure->name) selected @endif>
                                    {{ $a->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="departure_airport">Lotnisko startowe</label>
                    </div>
                    <div class="form-outline form-white mb-4">
                        <select class="form-control-lg w-100" id="destination_airport" name="destination_airport">
                            @foreach ($airports as $a)
                                <option value="{{$a->id}}" @if($a->name == $flight->destination->name) selected @endif>
                                    {{ $a->name }}
                                </option>
                            @endforeach
                        </select>
                        <label class="form-label" for="destination_airport">Lotnisko końcowe</label>
                    </div>
                    <div class="form-group"> <!-- Date input -->
                        <input class="form-control-lg w-100" id="date" name="departure_date" placeholder="YYYY-MM-DD" value="{{ $flight->departure_date }}" type="text"/>
                        <span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                        <label class="control-label" for="departure_date">Data wylotu</label>
                      </div>

                    <button class="btn btn-outline-light btn-lg px-5 mt-3" type="submit">Edytuj</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @include('shared.footer')
    @include('shared.js')
    <script>
        $(document).ready(function(){
      var date_input=$('input[name="departure_date"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
    </script>
</body>
</html>

