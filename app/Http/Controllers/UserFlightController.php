<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use App\Models\Trip;
use App\Models\Flight;
use App\Models\UserFlight;
use App\Models\User;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use App\Http\Middleware\CheckUser;

class UserFlightController extends Controller
{
    public function __construct()
    {
        $this->middleware(CheckUser::class)->except(['index', 'destroy']);
    }

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
        if(!Gate::allows('is-logged'))
            return redirect()->route('login');

        return view('userflights.reserve', [
            'trip' => Trip::findOrFail($id),
            'flights' => Flight::all()->where('trip_id', $id)->where('places', '>', 0)->where('departure_date','>',Carbon::now()),
        ]);

    }

    public function getAddToCart(Request $request, $id) {
        $flight = Flight::findOrFail($request->get('flight_id'));

        $request->validate([
            'amount_of_tickets' => 'required|integer|min:1|max:'.$flight->places,
            'flight_id' => 'required|integer|exists:flights,id',
        ]);

        if(!Gate::allows('is-logged'))
            return redirect()->route('login');

        $trip_price = Trip::findOrFail($flight->trip_id)->price;
        $tickets = $request->get('amount_of_tickets');

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($flight, $tickets, $trip_price, $flight->id);

        $request -> session()->put('cart', $cart);
        //dd($request->session()->get('cart'));
        return redirect()->route('trips.index');
    }

    public function getCart() {
        if(!Gate::allows('is-logged'))
            return redirect()->route('login');

        if(!Session::has('cart')) {
            return view('userflights.shopping-cart', ['flights' => null]);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('userflights.shopping-cart', ['flights' => $cart->items, 'totalPrice' => $cart->totalPrice]);
    }

    public function store(Request $request) {
        if(!Gate::allows('is-logged'))
            return redirect()->route('login');

        if(Session::has('cart')) {
            $store_carts = Session::get('cart');
            $cart = new Cart($store_carts);

            $items = $cart -> items;
            $totalPrice = $cart->totalPrice;

            DB::beginTransaction();

            $user = Auth::user();
            $user_bankbalance = $user->bank_balance;

            if($user_bankbalance < $totalPrice) {
                DB::rollback();
                return redirect()->back()->withErrors(__('custom.not_enough_cash'));
            } else {
                $user -> decrement('bank_balance', $totalPrice);
            }

            foreach($items as $it) {
                $price = $it['price'];
                $flight = Flight::findOrFail($it['flight']['id']);
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
                    'amount_of_tickets' => $places_wanted,
                    'price' => $price
                ]);

            }

            DB::commit();

            Session::forget('cart');

            return redirect()->route('userflights.index');
        }
    }

    //jeden bilet wycieczki
    public function deleteOne($f) {
        $items = Session::get('cart');
        $flight = Flight::findOrFail($f);
        $price = Trip::findOrFail($flight->trip_id)->price;

        $oldtotalprice = $items->totalPrice;

        $newtotalprice = $oldtotalprice-$price;
        $items->totalPrice = $newtotalprice;

        $items->totalQty--;

        if($items->items[$f]['qty'] == 1) {
            unset(Session::get('cart')->items[$f]);
            return redirect()->back();

        } else {
            $oldprice = $items->items[$f]['price'];
            $newprice = $oldprice - $price;

            $items->items[$f]['qty']--;

            $items->items[$f]['price'] = $newprice;
            Session::put('cart', $items);
        }

        return redirect()->back();
    }

    //wszystkie bilety jednej wycieczki
    public function delete($f) {
        $items = Session::get('cart');
        $flight = Flight::findOrFail($f);

        $deletingprice = $items->items[$f]['price'];
        $oldtotalprice = $items->totalPrice;
        $newtotalprice = $oldtotalprice-$deletingprice;

        $oldtotalqty = $items->totalQty;
        $deletingqty = $items->items[$f]['qty'];
        $newtotalqty = $oldtotalqty-$deletingqty;

        $items->totalQty = $newtotalqty;
        $items->totalPrice = $newtotalprice;

        Session::put('cart', $items);
        unset(Session::get('cart')->items[$f]);

        return redirect()->back();
    }

    public function deleteAll() {
        Session::forget('cart');

        return redirect()->back();
    }

    public function destroy($f) {
        if(!Gate::allows('is-logged'))
            return redirect()->route('login');

        try {
            $uf = UserFlight::where('id', $f)->first();
            $flight = Flight::where('id', $uf->flight_id)->first();

            if($flight->departure_date > Carbon::now()) {
                $amountsoftickets = $uf->amount_of_tickets;

                if(Gate::allows('is-admin'))
                    $cashback = ($uf->price);
                else
                    $cashback = ($uf->price)/2;

                User::findOrFail($uf->user_id)->increment('bank_balance', $cashback);

                Flight::findOrFail($flight->id)->increment('places', $uf->amount_of_tickets);
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
