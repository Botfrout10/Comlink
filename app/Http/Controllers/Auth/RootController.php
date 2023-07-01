<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class RootController extends Controller
{
    public function index()
    {
        return view('auth.rootcheck');
    }

    public function check(Request $request)
    {
        if($request->_token){
            $root_pass = Hash::make('Mehdi_1@_Zaaboul');
            if (Hash::check($request->password, $root_pass)) {
                return view('auth.register',['req' => $request]);
            } else {
                return redirect('login');
            }
        }else abort(403);
    }
}
