<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Admin;
use App\Models\Commercial;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PasswordRequest;
use App\Rules\CurrentPasswordCheckRule;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserPasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Admin::where('email', auth()->user()->email)->first();
        return view('users.showcomm', ['user' => $user]);
    }

    //show user add form
    public function create()
    {
        return view('users.useradd');
    }

    public function store(UserRequest $request)
    {
        $admin = Admin::where('email', auth()->user()->email)->first();
        $res = $admin->commercial()->create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $res1 = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'admin' => 0,
        ]);
        if ($res && $res1) {
            return redirect('user')->withStatus(__('User added succesfully.'));
        } else return back()->with('er', __('Oop Somethings goes wrong!!'));
    }

    public function show($user)
    {
        $comm = Commercial::findOrFail($user);
        return view('prospect.edit', ['comm' => $comm]);
    }

    public function edit($user)
    {
        $comm = Commercial::find($user);
        return view('users.useredite', ['comm' => $comm]);
    }

    public function update($user,Request $request)
    {
        $request->validate([
            'name' => [
                'required', 'min:3'
            ],
            'email' => [
                'required', 'email'
            ],
        ]);
        $comm = Commercial::find($user);
        $res = $comm->update(['name' => $request->name, 'email' => $request->email]);
        $users_row = User::where('email', $comm->email)->first();
        $res1 = $users_row->update(['name' => $request->name, 'email' => $request->email]);
        if ($res && $res1) {
            return back()->withStatus(__('Profile successfully updated.'));
        } else   return back()->with('er', __('Oops Probleme faced during update!!'));
    }
    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update_password($id, UserPasswordRequest $request)
    {
        $admin = Admin::query()->where('email', auth()->user()->email)->first();
        $comms = $admin->commercial();
        $comm = $comms->findOrFail($id);
        $rulecheck = Hash::check($request->old_password, $comm->password);
        if (!$rulecheck) {
            return back()->withPasswordErrors(__('Old Password dosen\'t match credentiels.'));
        }
        $user = User::query()->where('email', $admin->email);
        $res = $user->update(['password' => Hash::make($request->password)]);
        $res = $comm->update(['password' => Hash::make($request->password)]);
        if (!$res) {
            return back()->withPasswordErrors(__('Oops!! A Probleme.'));
        }
        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function destroy($user)
    {
        $comm = Commercial::findOrFail($user);
        $users_row = User::where('email', $comm->email)->first();
        $comm->delete();
        $res = $users_row->delete();
        if (!$res) {
            return redirect('user')->with('delete_status', 'User deleted succesfully.');
        } else {
            return redirect('user')->with('er', __('User deleted succesfully.'));
        }
    }
}
