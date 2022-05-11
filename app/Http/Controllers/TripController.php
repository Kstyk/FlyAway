<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;

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
}
