<?php

namespace App\Http\Controllers;

use App\Models\activity_log;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            //$settings = $request->email;
            //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
            activity_log::insert([
                'description' => 'admin melakukan login',
                'created_at' => $mytime,
                'ip' => $checkLocation->ip,
                'lokasi' => $checkLocation->city,
                'email' => $request->email
            ]);
            return redirect()->intended(route('admin.manage'));
        }
        return back()->with('error', 'Email atau Password Salah!');
    }

    public function logoutadmin()
    {
        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
        activity_log::insert([
            'description' => 'admin melakukan logout',
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);
        session()->flush();
        Auth::guard('admin')->logout();
        return redirect('/loginadmin');
    }
}
