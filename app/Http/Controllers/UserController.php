<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Exception;

class UserController extends Controller
{
    public function index() {
        if(Auth::check()) {
            if(Auth::user()->isAdmin()) {
                return view('users.index', [
                    'users' => User::all()
                ]);
            }
        }
    }

    public function show($id) {
        if(Auth::check()) {
            if(Auth::user()->isAdmin() || Auth::user()->id == $id) {
                return view('users.info', [
                    'user' => User::findOrFail($id)
                ]);
            } else
                 return redirect()->route('trips.index');
        } else
        return redirect()->route('trips.index');
    }

    public function edit($id) {
        if(Auth::check()){
            if(Auth::user()->isAdmin() || Auth::user()->id == $id) {
                return view('users.edit', [
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
            if(Auth::user()->isAdmin() || Auth::user()->id == $id) {

                    $request->validate([
                        'name' => 'required',
                        'surname' => 'required',
                        'date_of_birth' => 'required|integer|max:2004|min:1880',
                        'email' => 'required|min:0',
                    ]);

                $user = User::findOrFail($id);
                $input = $request->all();
                $user->update($input);
                return redirect()->route('users.show', $id);
            } else
            return redirect()->route('trips.index');
    } else {
        return redirect()->route('trips.index');
    }

    }

    public function destroy($id)
    {
        try {
            $query = User::where('id', $id)->delete();
            return redirect()->route('users.index');
        } catch(Exception $e) {
            return redirect()->route('users.index')->withErrors(['msg' => "Nie można usunąć tego użytkownika, ponieważ ma aktualnie zarezerwowane loty lub historię lotów."]);
        }
    }

}
