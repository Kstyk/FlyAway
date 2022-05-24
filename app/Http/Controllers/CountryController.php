<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;
use Auth;
use Illuminate\Database\QueryException;
use App\Http\Middleware\CheckAdmin;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckAdmin::class)->except(['index', 'show']);
    }

    public function index() {
        return view('countries.index', [
                'countries' => Country::paginate(6)
            ]);
    }

    public function show($id) {
        return view('countries.show', [
                'c' => Country::findOrFail($id)
            ]);
    }

    public function edit($id) {
        return view('countries.edit', [
                        'c' => Country::findOrFail($id),
                ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|unique:countries,name,'.$id,
            'iso3166' => 'required|min:0|max:3',
            'currency' => 'required|max:64',
            'total_surface' => 'required|numeric|min:1',
            'language' => 'required|min:0|max:64',
        ]);

        $c = Country::findOrFail($id);
        $input = $request->all();
        $c->update($input);
        return redirect()->route('countries.index');
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:countries',
            'iso3166' => 'required|min:0|max:3',
            'currency' => 'required|max:64',
            'total_surface' => 'required|numeric|min:1',
            'language' => 'required|min:0|max:64',
        ]);

        $input = $request->all();
        Country::create($input);

        return redirect()->route('countries.index');
    }

    public function destroy($c)
    {
        try {
            $query = Country::where('id', $c)->delete();
            return redirect()->route('countries.index');
        } catch(QueryException $e) {
            return redirect()->route('countries.index')->withErrors(__('custom.country_notdelete'));
        }
    }
}
