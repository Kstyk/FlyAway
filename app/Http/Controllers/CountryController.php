<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Auth;
use Exception;

class CountryController extends Controller
{
    public function index() {
        return view('countries.index', [
                'countries' => Country::all()
            ]);
    }

    public function show($id) {
        return view('countries.show', [
                'c' => Country::findOrFail($id)
            ]);
    }

    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->isAdmin()) {
                return view('countries.edit', [
                        'c' => Country::findOrFail($id),
                ]);
            } else
                return redirect()->route('countries.index');
        } else {
            return redirect()->route('countries.index');
        }
    }

    public function update(Request $request, $id)
    {
        if(!Auth::check())
            abort(403);

        if(!Auth::user()->isAdmin())
            abort(403);

        $request->validate([
            'nazwa' => 'required|max:255|unique:countries,nazwa,'.$id,
            'iso3166' => 'required|min:0|max:3',
            'waluta' => 'required|max:64',
            'powierzchnia_calkowita' => 'required|numeric|min:1',
            'jezyk_urzedowy' => 'required|min:0|max:64',
        ]);

        $c = Country::findOrFail($id);
        $input = $request->all();
        $c->update($input);
        return redirect()->route('countries.index');
    }

    public function create()
    {
        if(Auth::check())
            if(Auth::user()->isAdmin())
                return view('countries.create');
            else
                return redirect()->route('countries.index');
        else
            return redirect()->route('countries.index');
    }

    public function store(Request $request)
    {
        if(Auth::check())
            if(Auth::user()->isAdmin()) {
                $request->validate([
                    'nazwa' => 'required|max:255|unique:countries',
                    'iso3166' => 'required|min:0|max:3',
                    'waluta' => 'required|max:64',
                    'powierzchnia_calkowita' => 'required|numeric|min:1',
                    'jezyk_urzedowy' => 'required|min:0|max:64',
                ]);

                $input = $request->all();
                Country::create($input);

                return redirect()->route('countries.index');
            } else {
                return redirect()->route('countries.index');
            }
            return redirect()->route('countries.index');
        }

    public function destroy($c)
    {
        if(!Auth::check())
            return redirect()->route('countries.index');

        if(!Auth::user()->isAdmin())
            return redirect()->route('countries.index');

        try {
            $query = Country::where('id', $c)->delete();
            return redirect()->route('countries.index');
        } catch(Exception $e) {
            return redirect()->route('countries.index')->withErrors(['msg' => "Nie można usunąć tego kraju"]);
        }
    }
}