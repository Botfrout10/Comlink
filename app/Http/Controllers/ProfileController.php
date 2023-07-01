<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Models\Admin;
use App\Models\Commercial;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        if (auth()->user()->admin) {
            $admin = Admin::where('email', auth()->user()->email)->first();
            $sa = $admin->script_appel;
            return view('profile.edit', ['sa' => $sa]);
        } else {
            return view('profile.edit');
        }
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        if (auth()->user()->admin) {
            $admin = Admin::query()->where('email', auth()->user()->email)->first();
            $res = $admin->update($request->all());
        } else {
            $comm = Commercial::query()->where('email', auth()->user()->email)->first();
            $res = $comm->update($request->all());
        }
        if (!$res) {
            return back()->with('er', __('Oops!! A Probleme.'));
        }
        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function update_script(Request $request)
    {
        $request->validate([
            'script_appel' => ['required'],
        ]);
        $admin = Admin::where('email', auth()->user()->email)->first();
        $res = $admin->update([
            'script_appel' => $request->script_appel,
        ]);
        if (!$res) {
            return back()->with('script_errors', 'Oops!! A Probleme.');
        }
        return back()->with('script_status', 'Script successfully updated.');
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->password)]);
        if (auth()->user()->admin) {
            $admin = Admin::query()->where('email', auth()->user()->email);
            $res = $admin->update(['password' => Hash::make($request->password)]);
        } else {
            $comm = Commercial::query()->where('email', auth()->user()->email);
            $res = $comm->update(['password' => Hash::make($request->password)]);
        }
        if (!$res) {
            return back()->withPasswordErrors(__('Oops!! A Probleme.'));
        }
        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
