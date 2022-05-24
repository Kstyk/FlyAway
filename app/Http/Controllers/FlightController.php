<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Trip;
use Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use App\Http\Middleware\CheckAdmin;

class FlightController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdmin::class)->except(['index']);
    }

    public function index() {
        return view('flights.index', [
                'flights' => Flight::all()->where('departure_date','>',Carbon::now())->sortBy('departure_date'),
                'flights_arch' => Flight::all()->where('departure_date','<=',Carbon::now())->sortByDesc('departure_date'),
            ]);
    }

    public function create()
    {
        return view('flights.create', [
            'trips' => Trip::all(),
            'airports' => Airport::all()
        ]);
    }

    public function store(Request $request)
    {
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
    }

    public function edit($id) {
            return view('flights.edit', [
                'flight' => Flight::findOrFail($id),
                'trips' => Trip::all(),
                'airports' => Airport::all()
            ]);
    }

    public function update(Request $request, $id)
    {
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
        try {
            $query = Flight::where('id', $f)->delete();
            return redirect()->route('flights.index');
        } catch(QueryException $e) {
            return redirect()->route('flights.index')->withErrors(__('custom.flight_notdelete'));
        }
    }
}
