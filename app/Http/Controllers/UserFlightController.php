<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Trip;
use App\Models\Flight;
use App\Models\UserFlight;
use App\Models\User;
use Carbon\Carbon;

class UserFlightController extends Controller
{
    public function index()
    {
        if(Auth::check())
            if(Auth::user()->isAdmin()) {
                    return view('userflights.index', [
                        'uf' => UserFlight::all()
                    ]);
                } else {
                    return view('userflights.index', [
                        'uf' => UserFlight::all()->where('user_id', Auth::user()->id)
                    ]);
                }
        else
            return redirect()->route('trips.index');
    }

    public function create($id)
    {
        if(Auth::check())
                return view('userflights.reserve', [
                    'trip' => Trip::findOrFail($id),
                    'flights' => Flight::all()->where('trip_id', $id)->where('places', '>', 0)->where('departure_date','>',Carbon::now()),
                    'users' => User::all()->where('role_id', 2)
                ]);
        else
            return redirect()->route('login');
    }

    public function store(Request $request)
    {
        if(Auth::check()) {
                $request->validate([
                    'user_id' => 'required',
                    'flight_id' => 'required',
                    'amount_of_tickets' => 'required|integer',
                ]);

                Flight::find($request->get('flight_id'))->decrement('places', $request->get('amount_of_tickets'));
                $data = Carbon::now();

                UserFlight::create(array_merge($request->all(), ['date_of_purchase' => $data]));

                return redirect()->route('userflights.index');
            } else
            return redirect()->route('trips.index');
        }

    public function destroy($f) {
        try {
            $uf = UserFlight::where('id', $f)->first();
            $flight = Flight::where('id', $uf->flight_id)->first();

            if($flight->departure_date > Carbon::now()) {
                Flight::find($flight->id)->increment('places', $uf->amount_of_tickets);
                $query = UserFlight::where('id', $f)->delete();
            } else {
                $query = UserFlight::where('id', $f)->delete();
            }

            return redirect()->route('userflights.index');
        } catch(Exception $e) {
            return redirect()->route('userflights.index')->withErrors(['msg' => "Nie można usunąć tej rezerwacji!"]);
        }
    }
}
