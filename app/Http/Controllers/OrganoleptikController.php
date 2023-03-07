<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganoleptikController extends Controller
{
    public function index(Request $request){
        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
        ]);
    }
}
