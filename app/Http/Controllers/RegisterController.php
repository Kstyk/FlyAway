<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'date_of_birth' => 'required|integer|max:2004|min:1880',
            'email' => 'required|max:255|unique:users,email',
            'country_id' => 'required',
            'password' => 'required|max:255',
            'confirm_password' => 'same:password',
            'avatar' => 'image|max:255|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $filename = $image->getClientOriginalName();

            $img = Image::make($image->getRealPath());
            $img->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream();

            Storage::disk('public')->put('avatars'.'/'.$filename, $img, 'public');

            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'date_of_birth' => $request->date_of_birth,
                'email' => $request->email,
                'country_id' => $request->country_id,
                'password' => Hash::make($request->password),
                'role_id' => DB::table('roles')->where('name', 'user')->value('id'),
                'avatar' => $filename
            ]);
        } else {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'date_of_birth' => $request->date_of_birth,
                'email' => $request->email,
                'country_id' => $request->country_id,
                'password' => Hash::make($request->password),
                'role_id' => DB::table('roles')->where('name', 'user')->value('id'),
            ]);
        }

        Auth::login($user);

        return redirect()->route('trips.index');
    }

}
