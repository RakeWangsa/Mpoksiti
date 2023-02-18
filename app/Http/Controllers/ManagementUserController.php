<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ManagementUserController extends Controller
{
    public function __construct()
    {

    }

    private $table = "traders";
    public function all()
    {
        session()->put('email', Auth::user()->email);
        $manage = DB::select("SELECT * FROM $this->table");
        return $manage;
    }
}
