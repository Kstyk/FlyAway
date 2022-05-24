<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Country;
use Auth;
use Illuminate\Database\QueryException;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index() {
        if(!Gate::allows('is-admin')) {
            return redirect()->back()->withErrors(__('custom.not_allowed'));
        }
            return view('users.index', [
                'users' => User::all()
           ]);
        }


    public function show($id) {
        $user = User::findOrFail($id);
        if($user->cannot('view', [Auth::user(), $user]))
            return redirect()->back()->withErrors(__('custom.not_allowed'));
        return view('users.info', [
            'user' => User::findOrFail($id)
        ]);

    }

    public function edit($id) {
            $user = User::findOrFail($id);
            if($user->cannot('update', [Auth::user(), $user]))
                return redirect()->back()->withErrors(__('custom.not_allowed'));

            return view('users.edit', [
                'user' => $user,
                'countries' => Country::all(),
            ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($user->cannot('update', [Auth::user(), $user]))
            return redirect()->back()->withErrors(__('custom.not_allowed'));

        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'date_of_birth' => 'required|integer|max:2004|min:1880',
            'email' => 'required|min:0|unique:users,email,'.$id,
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
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if($user->cannot('delete', [Auth::user(), $user]))
            return redirect()->back()->withErrors(__('custom.not_allowed'));

        try {
            $query = User::where('id', $id)->delete();
            return redirect()->route('users.index');
        } catch(QueryException $e) {
            return redirect()->route('users.index')->withErrors(__('custom.user_notdelete'));
        }
    }

}
