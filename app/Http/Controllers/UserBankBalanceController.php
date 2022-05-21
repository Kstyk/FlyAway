<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Exception;

class UserBankBalanceController extends Controller
{
    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->id == $id) {
                return view('users.addmoney', [
                    'user' => User::findOrFail($id),
                ]);
            } else
                return redirect()->route('trips.index');
        } else {
            return redirect()->route('trips.index');
        }
    }

    public function update(Request $request, $id)
    {
        if(Auth::check()){
            if(Auth::user()->id == $id) {

                    $request->validate([
                        'bank_balance' => 'required|regex:/^\d+(\.\d{1,2})?$/'
                    ]);

                    $input = $request -> all();
                    User::findOrFail($id)->increment('bank_balance', $input['bank_balance']);

                return redirect()->route('users.show', $id);
            } else
            return redirect()->route('trips.index');
    } else {
        return redirect()->route('trips.index');
    }

    }
}
