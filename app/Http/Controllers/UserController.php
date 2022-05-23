<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Auth;
use Illuminate\Database\QueryException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
                    'countries' => Country::all(),
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
                        'email' => 'required|min:0|unique:users,email'.$id,
                        'country_id' => 'required',
                        'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg',
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

                        $requestData = $request->all();
                        $requestData['avatar'] = $filename;
                        $user = User::findOrFail($id);
                        $input = $requestData;
                        $user->update($input);
                    } else {
                        $requestData = $request->all();
                        $requestData['avatar'] = 'default.png';
                        $user = User::findOrFail($id);
                        $input = $requestData;
                        $user->update($input);
                    }

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
        } catch(QueryException $e) {
            return redirect()->route('users.index')->withErrors(__('custom.user_notdelete'));
        }
    }

}
