<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        // \Log::info(\Hash::make('webJPG#2528'));
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $remember = $request->remember ? true : false;

        $authValid = Auth::guard('web')->validate(['email' => $request->email, 'password' => $request->password, 'status' => 1]);

        if($authValid){
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password],$remember)) {
                return response()->json(route('home'), 200);
            }
        }else{
            return response()->json(['invalid' => 'Email ou Senha invalidos!'], 422);
        }
    }

    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        return redirect()->route('login');
    }
}
