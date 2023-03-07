<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class OrganoleptikController extends Controller
{
    public function index(Request $request){

        $header = DB::connection('sqlsrv2')->table('v_data_header')
            ->where('id_ppk', '20')
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'header'=>$header
        ]);
    }
}
