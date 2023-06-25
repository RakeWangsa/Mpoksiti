<?php

namespace App\Http\Controllers;

use App\Models\activity_log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
//use App\Http\Traits\GlobalTrait;
use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

class LoginAdminController extends Controller
{
    //use GlobalTrait;
    //public $settings;
    public function __construct()
    {
        $this->middleware('guest')->except('logoutadmin');
        $this->middleware('guest:admin')->except('logoutadmin');
        //$this->settings = $this->getAllSettings();
        //$this->email = 'tess';
    }

    public function formLogin()
    {
        return view('loginadmin');
    }

    
    public function username()
    {
        //return Auth::user()->email;
    }

    public function loginAdmin(Request $request)
    {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
            $mytime = Carbon::now();
            $ip = $request->ip();
            //$settings = $request->email;
            //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
            activity_log::insert([
                'description' => 'admin melakukan login',
                'created_at' => $mytime,
                'ip' => $ip,
                'lokasi' => $checkLocation->city,
                'email' => $request->email
            ]);
            $role = DB::table('admins')
            ->where('email', $request->email)
            ->pluck('jenis_admin')
            ->first();
            Session::put('role', $role);
            if($role=='Admin'){
                return redirect()->intended(route('admin.manage'));
            }else{
                return redirect()->intended(route('admin.PK-pemeriksaan_klinis'));
            }
            
        }
        return back()->with('error', 'Email atau Password Salah!');
    }

    public function logoutadmin(Request $request)
    {
        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        $ip = $request->ip();
        //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
        activity_log::insert([
            'description' => 'admin melakukan logout',
            'created_at' => $mytime,
            'ip' => $ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);
        session()->flush();
        Auth::guard('admin')->logout();
        return redirect('/loginadmin');
    }
}
