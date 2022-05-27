<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Exception;
use Session;
use App\Models\Trip;
use App\Models\Flight;
use App\Models\UserFlight;
use App\Models\User;
use App\Models\Cart;
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

    public function getAddToCart(Request $request, $id) {
        $flight = Flight::find($request->get('flight_id'));
        $trip_price = Trip::find($flight->trip_id)->price;
        $tickets = $request->get('amount_of_tickets');

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($flight, $tickets, $trip_price, $flight->id);

        $request -> session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('trips.index');
    }

    public function getCart() {
        if(!Session::has('cart')) {
            return view('userflights.shopping-cart', ['flights' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('userflights.shopping-cart', ['flights' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function store(Request $request) {
        if(Session::has('cart')) {
            $store_carts = Session::get('cart');
            $cart = new Cart($store_carts);

            $items = $cart -> items;
            $totalPrice = $cart->totalPrice;

            DB::beginTransaction();

            $user = User::find($request->get('user_id'));
            $user_bankbalance = $user->bank_balance;

            if($user_bankbalance < $totalPrice) {
                DB::rollback();
                return redirect()->back()->withErrors(__('custom.not_enough_cash'));
            } else {
                $user -> decrement('bank_balance', $totalPrice);
            }

            foreach($items as $it) {

                $flight = Flight::find($it['flight']['id']);
                $date = Carbon::now();

                $places = $flight->places;
                $places_wanted = $it['qty'];

                if($places < $places_wanted) {
                    DB::rollback();
                    return redirect()->back()->withErrors(__('custom.too_late'));
                }

                $flight->decrement('places', $places_wanted);

                UserFlight::create([
                    'user_id' => $user->id,
                    'flight_id' => $flight->id,
                    'date_of_purchase' => $date,
                    'amount_of_tickets' => $places_wanted
                ]);

            }

            DB::commit();

            Session::forget('cart');

            return redirect()->route('userflights.index');
        }
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
