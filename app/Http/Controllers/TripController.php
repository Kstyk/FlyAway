<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Trip;
use App\Models\Country;
use Auth;
use Illuminate\Database\QueryException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\CheckAdmin;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdmin::class)->except(['index', 'show']);
    }

    public function index() {
        return view('trips.index', [
                'trips' => Trip::paginate(6)
            ]);
    }

    public function show($id) {
        return view('trips.show', [
                'trip' => Trip::findOrFail($id)
            ]);
    }

    public function create()
    {
        return view('trips.create', [
            'countries' => Country::all()
        ]);
    }

    public function store(Request $request)
    {
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
    }

    public function edit($id) {
        return view('trips.edit', [
                'trip' => Trip::findOrFail($id),
                'countries' => Country::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:trips,name,'.$id,
            'continent' => 'required',
            'period' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'describe' => 'required|min:0|max:1000',
            'country_id' => 'required',
            'img_name' => 'image|unique:trips|mimes:jpeg,png,jpg,gif,svg',
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

            $trip = Trip::findOrFail($id);
            $input = $requestData;
            $trip->update($input);
            return redirect()->route('trips.index');
        } else {
            $trip = Trip::findOrFail($id);
            $input = $request->all();
            $trip->update($input);
            return redirect()->route('trips.index');
        }
    }

    public function destroy(Trip $trip)
    {
        try {
            $trip->delete();
            return redirect()->route('trips.index');
        } catch(QueryException $e) {
            return redirect()->route('trips.index')->withErrors(__('custom.trip_notdelete'));
        }
    }
}
