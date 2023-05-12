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

    public function register(Request $request)
    {
        $Member = Member::create($request->all());

        return response()->json([
            "data"=> $Member
        ]);

        $input = $request->all();
        $input['password'] = bcrypt($request->password);
        unset($input['konfirmasi_password']);
        $Member = Member::create($input);

        return response()->json([
            "data"=> $Member
        ]);
    }

    public function login_member(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $member = Member::where('email', $request->email)->first();

        return response()->json([
            "message"=> 'success',
            'data'=> $member
        ]);
    } 

    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }

    public function logout_member ()
    {
        Session::flush();
        return redirect('/login_member');
    }
}    