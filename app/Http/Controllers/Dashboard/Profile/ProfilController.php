<?php

namespace App\Http\Controllers\Dashboard\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfilController extends Controller
{
    //
    function showProfile() {
        $user = Auth::user();
        return view('admin.profile.show', compact('user'));
    }

    function settingsProfile() {
        $user = Auth::user();
        return view('admin.profile.settings.index', compact('user'));
    }

    function updatePersonalInfo(Request $request) {
        
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|string',
                'firstname' => 'required|string',
                'user_id' => 'required|exists:users,id',
                'slug' => 'required|string',
                'email' => 'required|email',
                'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
                'whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
                'avatar' => 'mimes:jpg,jpeg,png',
                'pays' => 'nullable|string',
                'ville' => 'nullable|string',
                'commune' => 'nullable|string',
                'departement' => 'nullable|string',
            ]
        );
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $user = Auth::user();

        if ($user->id === (int) $request->user_id && $user->slug === $request->slug) {
            
            $user->name = $request->name;
            $user->firstname = $request->firstname;
            $user->telephone = $request->telephone;
            $user->whatsapp = $request->whatsapp;
            $user->pays = $request->pays;
            $user->ville = $request->ville;
            $user->commune = $request->commune;
            $user->departement = $request->departement;

            $user->save();

            if ($request->hasFile('avatar')) {
                $user->addMedia($request->file('avatar'))
                    ->preservingOriginal()
                    ->toMediaCollection('avatar');
            }

            session()->flash('success', 'Vos informations ont été modifié avec succès');
            return redirect()->back();
        }

        session()->flash('error', 'Une erreur s\'est produite, veuillez rééssayer.');
        return redirect()->back();
    }

    function resetPassword(Request $request) {
        
        $validator = Validator::make(
            $request->all(),
            [
                'current_password' => 'required|string',
                'password' => 'required|confirmed|min:12',
            ]
        );
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        if (!Hash::check($request->current_password, Auth::user()->password)) {
            session()->flash('error', 'Mot de passe courant incorrect');
            return redirect()->back();
        }

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->save();

        session()->flash('success', 'Mot de passe modifié avec succès.');
        return redirect()->back();
    }
}
