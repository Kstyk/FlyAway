<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Airport;
use App\Models\Country;
use Auth;
use Illuminate\Database\QueryException;
use App\Http\Middleware\CheckAdmin;

class AirportController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdmin::class)->except(['index', 'show']);
    }

    public function index() {
        return view('airports.index', [
                'airports' => Airport::paginate(6)
            ]);
    }

    public function show($id) {
        return view('airports.show', [
                'airport' => Airport::findOrFail($id)
            ]);
    }

    public function create()
    {
        return view('airports.create', [
            'countries' => Country::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:128|unique:airports',
            'city' => 'required|max:64',
            'country_id' => 'required|integer|exists:countries,id',
        ]);

        $input = $request->all();
        Airport::create($input);

        return redirect()->route('airports.index');
    }

    public function edit($id) {
        return view('airports.edit', [
                'airport' => Airport::findOrFail($id),
                'countries' => Country::all()
            ]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:128|unique:airports,name,'.$id,
            'city' => 'required|max:64',
            'country_id' => 'required|integer|exists:countries,id',
        ]);

        $airport = Airport::findOrFail($id);
        $input = $request->all();
        $airport->update($input);
        return redirect()->route('airports.index');
    }

    public function destroy(Airport $airport)
    {
        try {
            $airport->delete();
            return redirect()->route('airports.index');
        } catch(QueryException $e) {
            return redirect()->route('airports.index')->withErrors(__('custom.airport_notdelete'));
        }
    }
}
