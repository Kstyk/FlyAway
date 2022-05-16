<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use App\Models\Trip;
use Auth;
use Exception;

class FlightController extends Controller
{
    public function index() {
        return view('flights.index', [
                'flights' => Flight::all(),
            ]);
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
                abort(403);
        } else {
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::check())
            abort(403);

        if(!Auth::user()->isAdmin())
            abort(403);

        $request->validate([
            'trip_id' => 'required',
            'nazwa_linii' => 'required|max:128',
            'liczba_miejsc' => 'required|integer|min:1',
            'airport_id' => 'required',
            'airport_id_2' => 'required',
            'data_wylotu' => 'required|date|after:tomorrow|date_format:Y-m-d',
        ]);

        $flight = Flight::findOrFail($id);
        $input = $request->all();
        $flight->update($input);
        return redirect()->route('flights.index');
    }
}
