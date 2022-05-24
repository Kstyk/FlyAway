<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use App\Models\Trip;
use App\Models\Flight;
use App\Models\UserFlight;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class UserFlightController extends Controller
{
    public function index()
    {
                if(Gate::allows('is-admin')) {
                    return view('userflights.index', [
                        'uf' => UserFlight::all()
                    ]);
                } else {
                    return view('userflights.index', [
                        'uf' => UserFlight::all()->where('user_id', Auth::user()->id)
                    ]);
                }
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

                DB::beginTransaction();
                try {
                    $flight = Flight::find($request->get('flight_id'));
                    $trip_price = Trip::find($flight->trip_id)->price;
                     // dd($trip_price);

                     $user_bankbalance = User::find($request->get('user_id'))->bank_balance;
                    // dd($user_bankbalance);

                    $needed_cash = $trip_price * $request->get('amount_of_tickets');
                    // dd($needed_cash);

                    if($user_bankbalance >= $needed_cash) {
                        User::find($request->get('user_id'))->decrement('bank_balance', round($needed_cash, 2));
                        Flight::find($request->get('flight_id'))->decrement('places', $request->get('amount_of_tickets'));
                        $data = Carbon::now();

                        UserFlight::create(array_merge($request->all(), ['date_of_purchase' => $data]));

                        DB::commit();

                        return redirect()->route('userflights.index');
                    } else {
                        if(!Gate::allows('is-admin'))
                            return redirect()->route('reserve', $flight->trip_id)->withErrors(['msg' => 'Nie stać cię na tyle biletów! Sprawdź swój stan konta.']);
                        else
                            return redirect()->route('reserve', $flight->trip_id)->withErrors(['msg' => 'Ten użytkownik ma za niski stan konta na taką ilość biletów.']);
                    }
                } catch(Exception $ex) {
                    DB::rollback();
                    return redirect()->back()->withErrors(__('custom.not_reserved'));
                }
            } else
            return redirect()->route('trips.index');

        }

    public function destroy($f) {
        try {
            $uf = UserFlight::where('id', $f)->first();
            $flight = Flight::where('id', $uf->flight_id)->first();

            if($flight->departure_date > Carbon::now()) {
                $trip_price = Trip::find($flight->trip_id)->price;
                $amountsoftickets = $uf->amount_of_tickets;

                if(Gate::allows('is-admin'))
                    $cashback = ($trip_price*$amountsoftickets);
                else
                    $cashback = ($trip_price*$amountsoftickets)/2;

                User::find($uf->user_id)->increment('bank_balance', $cashback);

                Flight::find($flight->id)->increment('places', $uf->amount_of_tickets);
                $query = UserFlight::where('id', $f)->delete();
            } else {
                $query = UserFlight::where('id', $f)->delete();
            }

            return redirect()->route('userflights.index');
        } catch(QueryException $e) {
            return redirect()->route('userflights.index')->withErrors(__('custom.userflight_notdelete'));
        }
    }
}
