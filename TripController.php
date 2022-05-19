<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Trip;
use App\Models\Country;
use Auth;
use Exception;

class TripController extends Controller
{
    public function index() {
        return view('trips.index', [
                'trips' => Trip::all()
            ]);
    }

    public function create()
    {
        if(Auth::check())
            if(Auth::user()->isAdmin())
                return view('trips.create', [
                    'countries' => Country::all()
                ]);
            else
                return redirect()->route('trips.index');
        else
            return redirect()->route('trips.index');
    }

    public function store(Request $request)
    {
        if(Auth::check())
            if(Auth::user()->isAdmin()) {
                if ($request->hasFile('img_name')) {
                    $image      = $request->file('img_name');
                    $img_name  = time() . '.' . $image->getClientOriginalExtension();

                    $img = Image::make($image->getRealPath());
                    $img->resize(1280, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $img->stream(); // <-- Key point

                    //dd();
                    File::move(public_path($img), public_path('img_trips/'.$img_name));//jeszcze nie działa
                }

                $request->validate([
                    'nazwa' => 'required|unique:trips',
                    'kontynent' => 'required',
                    'okres_trwania' => 'required|integer|min:0',
                    'cena' => 'required|numeric|min:0',
                    'opis' => 'required|min:0|max:1000',
                    'country_id' => 'required',
                    'img_name' => 'required|unique:trips',
                ]);

                $input = $request->all();
                Trip::create($input);

                return redirect()->route('trips.index');
            } else {
                return redirect()->route('trips.index');
            }
        else return redirect()->route('trips.index');
    }


    public function show($id) {
        return view('trips.show', [
                'trip' => Trip::findOrFail($id)
            ]);
    }

    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->isAdmin()) {
                return view('trips.edit', [
                        'trip' => Trip::findOrFail($id),
                        'countries' => Country::all()
                ]);
            } else
                return redirect()->route('trips.index');
        } else {
            return redirect()->route('trips.index');
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::check())
            return redirect()->route('trips.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('trips.index');

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
        if(!Auth::check())
            return redirect()->route('trips.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('trips.index');

        try {
            $trip->delete();
            return redirect()->route('trips.index');
        } catch(Exception $e) {
            return redirect()->route('trips.index')->withErrors(['msg' => "Nie można usunąć tej wycieczki"]);
        }
    }
}
