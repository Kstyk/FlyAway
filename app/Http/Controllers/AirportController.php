<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Country;
use Auth;
use Exception;

class AirportController extends Controller
{
    public function index() {
        return view('airports.index', [
                'airports' => Airport::all()
            ]);
    }

    public function show($id) {
        return view('airports.show', [
                'airport' => Airport::findOrFail($id)
            ]);
    }

    public function create()
    {
        if(Auth::check())
            if(Auth::user()->isAdmin())
                return view('airports.create', [
                    'countries' => Country::all()
                ]);
            else
                return redirect()->route('airports.index');
        else
            return redirect()->route('airports.index');
    }

    public function store(Request $request)
    {
        if(Auth::check())
            if(Auth::user()->isAdmin()) {
                $request->validate([
                    'nazwa' => 'required|unique:airports',
                    'miasto' => 'required|max:64',
                    'country_id' => 'required',
                ]);

                $input = $request->all();
                Airport::create($input);

                return redirect()->route('airports.index');
            } else {
                return redirect()->route('airports.index');
            }
        else return redirect()->route('airports.index');
    }

    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->isAdmin()) {
                return view('airports.edit', [
                        'airport' => Airport::findOrFail($id),
                        'countries' => Country::all()
                ]);
            } else
                return redirect()->route('airports.index');
        } else {
            return redirect()->route('airports.index');
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::check())
             return redirect()->route('airports.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('airports.index');

        $request->validate([
            'nazwa' => 'required|unique:airports,nazwa,'.$id,
            'miasto' => 'required|max:64',
            'country_id' => 'required',
        ]);

        $airport = Airport::findOrFail($id);
        $input = $request->all();
        $airport->update($input);
        return redirect()->route('airports.index');
    }

    public function destroy(Airport $airport)
    {
        if(!Auth::check())
            return redirect()->route('airports.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('airports.index');

        try {
            $airport->delete();
            return redirect()->route('airports.index');
        } catch(Exception $e) {
            return redirect()->route('airports.index')->withErrors(['msg' => "Nie można usunąć tego lotniska"]);
        }
    }
}
