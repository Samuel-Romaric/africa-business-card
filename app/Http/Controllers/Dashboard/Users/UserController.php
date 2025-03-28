<?php

namespace App\Http\Controllers\Dashboard\Users;

use App\Http\Controllers\Controller;
use App\Mail\UserCredentialsMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{
    //
    function index() {
        $users = User::where('role', 'admin')->get();
        return view('admin.users.index', compact('users'));
    }

    function blockedUser($user_id) {

        $userAuth = Auth::user()->id;

        $user = User::where('id', $user_id)->first();

        if ($user->id === $userAuth) {
            session()->flash('error', 'Désolé vous ne pouvez pas vous bloquer');
            return redirect()->back();
        }

        if (!$user->isBlocked()) {
            $user->is_blocked = 1;
            $user->save();

            session()->flash('success', $user->getFullName() .' à été bloqué avec succès');
            return redirect()->back();
        }

        $user->is_blocked = 0;
        $user->save();

        session()->flash('success', $user->getFullName() .' à été débloqué avec succès');
        return redirect()->back();
    }

    function showUser($user_id, $slug) {
        $user = User::where('id', $user_id)->where('role', 'admin')->first();
        
        if (!$user) {
            session()->flash('error', 'Une erreur est surnevu, veullez réésayer plus tard.');
            return redirect()->back();
        }

        return view('admin.users.show', compact('user'));
    }

    function editUser($user_id, $slug) {
        $user = User::where('id', $user_id)->where('role', 'admin')->first();

        return view('admin.users.edit', compact('user'));
    }

    function updatePersonalUserInfo(Request $request) {

        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'firstname' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'avatar' => 'mimes:jpg,jpeg,png',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $user = User::where('id', $request->user_id)->where('slug', $request->slug)->first();
        
        if (!is_null($user)) {

            $user->name;
            $user->firstname;
            $user->email;
            $user->telephone;
            $user->whatsapp;
            $user->save();

            if ($request->hasFile('avatar')) {
                $user->addMedia($request->file('avatar'))
                    ->preservingOriginal()
                    ->toMediaCollection('avatar');
            }
            
            session()->flash('success', 'Mise à jour effectuée avec succès!');
            return redirect()->back();
        }
        
        session()->flash('error', 'Une erreur est survenu!');
        return redirect()->back();
    }

    function resetUserPassword(Request $request) {

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|string',
            'new_password' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $user = User::where('id', $request->user_id)->where('slug', $request->slug)->first();

        if (!$user) {
            session()->flash('error', 'Désolé une erreur est survenu !');
            return redirect()->back();
        }

        $email = $request->email;
        $password = $request->new_password;

        $user->password = Hash::make($password);
        $user->save();

        Mail::to($user->email)->send(new UserCredentialsMail($user, $email, $password));

        session()->flash('success', 'Nouveau mot de passe '. $request->new_password .' ajouté avec succès !');
        return redirect()->back();
    }

    function addPermissionUser(Request $request) {

        $validator = Validator::make($request->all(),[
            'user_id' => 'required|exists:users,id',
            'slug' => 'required|string',
            'permission' => 'required|string',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $user = User::where('id', $request->user_id)->where('slug', $request->slug)->first();
        
        if ($request->permission === 'is_global') {
            $user->is_global_admin = 1;
            $user->save();

            session()->flash('success', 'Permission accorder avec succès');
            return redirect()->back();
        } else {
            $user->is_global_admin = 0;
            $user->save();

            session()->flash('success', 'Permission rétirée avec succès');
            return redirect()->back();
        }
    }

    function showAddFormUser() {
        return view('admin.users.add-form');
    }

    function addUser(Request $request) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|string',
            'firstname' => 'required|string',
            'email' => 'required|email',
            'telephone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'whatsapp' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/',
            'avatar' => 'mimes:jpg,jpeg,png',
        ]);
        
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            session()->flash('error', $error);
            return redirect()->back();
        }

        $email = $request->email;
        $password = substr(str_shuffle("abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+"), 0, 12);
        $slug = $request->name.'-'.$request->firstname;

        $user = User::create([
            'name' => $request->name,
            'firstname' => $request->firstname,
            'slug' => Str::slug($slug),
            'email' => $request->email,
            'password' => Hash::make($password),
            'telephone' => $request->telephone,
            'whatsapp' => $request->whatsapp,
            'role' => 'admin',
        ]);

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->file('avatar'))
                ->preservingOriginal()
                ->toMediaCollection('avatar');
        }

        Mail::to($user->email)->send(new UserCredentialsMail($user, $email, $password));

        session()->flash('success', 'Nouvel administrateur ajouté avec succès');
        return redirect()->route('admin.users.index');
    }
}
