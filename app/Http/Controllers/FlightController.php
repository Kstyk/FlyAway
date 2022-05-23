<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Trip;
use Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;

class FlightController extends Controller
{
    public function index() {
        return view('flights.index', [
                'flights' => Flight::all()->where('departure_date','>',Carbon::now())->sortBy('departure_date'),
                'flights_arch' => Flight::all()->where('departure_date','<=',Carbon::now())->sortByDesc('departure_date'),
            ]);
    }

    public function create()
    {
        if(Auth::check() && Auth::user()->isAdmin()) {
                return view('flights.create', [
                    'trips' => Trip::all(),
                    'airports' => Airport::all()
                ]);
            }
        return redirect()->route('flights.index');
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
            if(Auth::user()->isAdmin()) {
                $request->validate([
                    'trip_id' => 'required',
                    'airline_name' => 'required|max:128',
                    'places' => 'required|integer|min:1',
                    'departure_airport' => 'required',
                    'destination_airport' => 'required|different:departure_airport',
                    'departure_date' => 'required|date|after:today|date_format:Y-m-d',
                ]);

                $input = $request->all();
                Flight::create($input);

                return redirect()->route('flights.index');
            } else {
                return redirect()->route('flights.index');
            }
        }
        return redirect()->route('flights.index');
    }

    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->isAdmin()) {
                return view('flights.edit', [
                        'flight' => Flight::findOrFail($id),
                        'trips' => Trip::all(),
                        'airports' => Airport::all()
                ]);
            } else
                return redirect()->route('flights.index');
        } else {
            return redirect()->route('flights.index');
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::check())
            return redirect()->route('flights.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('flights.index');

        $request->validate([
            'trip_id' => 'required',
            'airline_name' => 'required|max:128',
            'places' => 'required|integer|min:1',
            'departure_airport' => 'required',
            'destination_airport' => 'required|different:departure_airport',
            'departure_date' => 'required|date|after:today|date_format:Y-m-d',
        ]);

        $flight = Flight::findOrFail($id);
        $input = $request->all();
        $flight->update($input);
        return redirect()->route('flights.index');
    }

    public function destroy($f)
    {
        if(!Auth::check())
            return redirect()->route('flights.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('flights.index');

        try {
            $query = Flight::where('id', $f)->delete();
            return redirect()->route('flights.index');
        } catch(QueryException $e) {
            return redirect()->route('flights.index')->withErrors(['msg' => "Nie można usunąć tego lotu - ktoś go już zarezerwował!"]);
        }
    }
}
