<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        if (Auth::check()) {
            return redirect()->route('trips.index');
        }
        return view('auth.register', [
            'countries' => Country::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required|integer|max:2004|min:1880',
            'email' => 'required|unique:users,email',
            'country_id' => 'required',
            'password' => 'required',
            'confirm_password' => 'same:password'
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'country_id' => $request->country_id,
            'password' => Hash::make($request->password),
            'role_id' => DB::table('roles')->where('name', 'user')->value('id'),
        ]);

        Auth::login($user);

        return redirect()->route('trips.index');
    }

}
