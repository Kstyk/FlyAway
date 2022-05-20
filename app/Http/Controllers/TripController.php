<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Trip;
use App\Models\Country;
use Auth;
use Exception;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
                $request->validate([
                    'name' => 'required|unique:trips',
                    'continent' => 'required',
                    'period' => 'required|integer|min:0',
                    'price' => 'required|numeric|min:0',
                    'describe' => 'required|min:0|max:1000',
                    'country_id' => 'required',
                    'img_name' => 'image|required|unique:trips|mimes:jpeg,png,jpg,gif,svg',
                ]);

                if ($request->hasFile('img_name')) {
                    $image      = $request->file('img_name');
                    $filename = $image->getClientOriginalName();

                    $img = Image::make($image->getRealPath());
                    $img->resize(1280, 720, function ($constraint) {
                        $constraint->aspectRatio();
                    });

                    $img->stream(); // <-- Key point

                    //dd();
                    Storage::disk('public')->put('img_trips'.'/'.$filename, $img, 'public');

                    $requestData = $request->all();
                    $requestData['img_name'] = $filename;
                }

                $input = $requestData;
                Trip::create($input);

                return redirect()->route('trips.index');
            } else {
                return redirect()->route('trips.index');
            }
        else return redirect()->route('trips.index');
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
                'name' => 'required|unique:trips,name,'.$id,
                'continent' => 'required',
                'period' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'describe' => 'required|min:0|max:1000',
                'country_id' => 'required',
                'img_name' => 'image|required|unique:trips|mimes:jpeg,png,jpg,gif,svg',
            ]);

            if ($request->hasFile('img_name')) {
                $image      = $request->file('img_name');
                $filename = $image->getClientOriginalName();

                $img = Image::make($image->getRealPath());
                $img->resize(1280, 720, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->stream(); // <-- Key point

                //dd();
                Storage::disk('public')->put('img_trips'.'/'.$filename, $img, 'public');

                $requestData = $request->all();
                $requestData['img_name'] = $filename;
            }

        $trip = Trip::findOrFail($id);
        $input = $requestData;
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
