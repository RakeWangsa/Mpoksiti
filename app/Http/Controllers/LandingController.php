<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
// use App\Models\User;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing', [
            "title" => "Welcome to Mpok Siti",
            // "kategori" => KategoriDokumen::all(),
        ]);
    }
}