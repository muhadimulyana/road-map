<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function show_login_form()
    {
        return view('login');
    }

    public function process_login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        //dd($request);

        //$credentials = $request->except(['_token']);

        $user = User::where('User_Name',$request->username)->where('Pass', $request->password)->first();

        if ($user) {
            auth()->login($user, true);
            return redirect()->route('/');

        }else{
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput();;
        }
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
}
