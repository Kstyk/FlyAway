<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Trip;
use App\Models\Country;
use Exception;

class TripController extends Controller
{
    public function index() {
        return view('trips.index', [
                'trips' => Trip::all()
            ]);
    }

    public function show($id) {
        return view('trips.show', [
                'trip' => Trip::findOrFail($id)
            ]);
    }

    public function edit($id) {
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        return view('trips.edit', [
                'trip' => Trip::findOrFail($id),
                'countries' => Country::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        // 9.11
        if (!Gate::allows('is-admin')) {
            abort(403);
        }

        $request->validate([
            'nazwa' => 'required|unique:trips,nazwa,'.$id,
            'kontynent' => 'required',
            'okres_trwania' => 'required|integer|min:0',
            'cena' => 'required|numeric|min:0',
            'opis' => 'required|min:0|max:1000',
            'country_id' => 'required',
        ]);

        $trip = Trip::findOrFail($id);
        $input = $request->all();
        $trip->update($input);
        return redirect()->route('trips.index');
    }

    public function destroy(Trip $trip)
    {
        try {
            $trip->delete();
            return redirect()->route('trips.index');
        } catch(Exception $e) {
            return redirect()->route('trips.index')->withErrors(['msg' => "Nie można usunąć tej wycieczki"]);
        }
    }
}
