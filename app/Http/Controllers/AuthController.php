<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    { 
       return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
  
        $credentials = request(['email','password']);

 
        if (auth()->attempt($credentials)) {
            $token = Auth::guard('api')->attempt($credentials);
            cookie()->queue(cookie('token',$token, 60));
            return redirect('/dashboard'); 
        }
        return back()->withErrors([
            'error' => 'email atau password salah'
        ]);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}    