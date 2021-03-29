<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function show_login_form()
    {
        return view('logins');
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
            $access = DB::table('whole_system')->where('val1',$request->username)->where('wh_sys_id', 'ACCESS-ALL')->first();
            if($access) {
                $request->session()->put('username', $user->User_Name);
                auth()->login($user, true);
                return redirect()->route('/');
            } else {
                return back()->withErrors([
                    'username' => 'Anda tidak memiliki akses',
                ])->withInput();;
            }

        }else{
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->forget('username');
        return redirect()->route('login');
    }
}
