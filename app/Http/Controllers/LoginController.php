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

    public function process_login_2(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::whereRaw('USERNAME = ? AND FROM_BASE64(`PASSWORD`) = ?', [$request->username, $request->password])->first();

        if ($user) {

            $karyawan = DB::table('hrd_2021.viewkaryawan')->whereRaw('NIK = ? AND AKTIF = 1', [$user->NIK])->first();

            $akses = DB::table('user_2021.user_module')->whereRaw('USERNAME = ? AND PROGRAM = ?', [$request->username, 'ROADMAP'])->get();

            $akses_module = [];
            
            $user_session = [
                'USERNAME' => $user->USERNAME,
                'PIN' => $user->PIN,
                'NAMA' => ($karyawan) ? $karyawan->NAMA : $user->ALIAS
            ];

            foreach($akses as $row) {

                if($row->AKSES_PLANT === '%') {
                    $akses_plant = ['ERA', 'ERI', 'ETR'];
                } else {
                    $akses_plant = [];
                    $plant = explode(',', $row->AKSES_PLANT);
                    foreach($plant as $key => $val){
                        $v = str_replace(array('\'', '"'), '', $val);
                        array_push($akses_plant, $v);
                    } 
                }

                if($row->AKSES_DIVISI === '%') {
                    $akses_divisi = [
                        'ENG',
                        'FAT',
                        'IAU',
                        'IVC',
                        'LAC',
                        'LOG',
                        'PCO',
                        'PLT',
                        'PPC',
                        'PRC',
                        'PRE',
                        'QHS',
                        'QUA',
                        'RAD',
                        'SAM',
                        'SRC',
                        'HRD'
                    ];
                } else {
                    $akses_divisi = [];
                    $divisi = explode(',', $row->AKSES_DIVISI);
                    foreach($divisi as $key => $val){
                        $v = str_replace(array('\'', '"'), '', $val);
                        array_push($akses_divisi, $v);
                    } 
                }

                if($row->VAL1 === '%') {
                    $akses_input = [
                        'LOCO',
                        'ETERLENE',
                        'SOURCING'
                    ];
                } else {
                    $akses_input = [];
                    $input = explode(',', $row->VAL1);
                    foreach($input as $key => $val){
                        $v = str_replace(array('\'', '"'), '', $val);
                        array_push($akses_input, $v);
                    } 
                }

                $akses_module[$row->MODULE] = [
                    'BUKA' => $row->BUKA,
                    'BARU' => $row->BARU,
                    'EDIT' => $row->EDIT,
                    'HAPUS' => $row->HAPUS,
                    'CETAK' => $row->CETAK,
                    'OTORISASI' => $row->OTORISASI,
                    'FINALIZE' => $row->FINALIZE,
                    'AKSES_PLANT' => $akses_plant,
                    'AKSES_DIVISI' => $akses_divisi,
                    'AKSES_INPUT' => $akses_input,
                    'AKSES_INPUT_ALL' => (count($akses_input) > 1) ? 1 : 0 
                ];
            }

            //dd($akses_module);

            if($akses_module['app']['BUKA'] == 0) {
                return back()->withErrors([
                    'username' => 'Anda tidak memiliki akses',
                ])->withInput();;
            }
            

            $request->session()->put('user', $user_session);
            $request->session()->put('akses', $akses_module);

            auth()->login($user, true);
            return redirect()->route('/');

        } else {
            return back()->withErrors([
                'username' => 'Username atau password salah',
            ])->withInput();
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->forget('username');
        $request->session()->forget('akses');
        return redirect()->route('login');
    }
}
