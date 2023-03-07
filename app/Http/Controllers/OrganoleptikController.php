<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\organoleptik;
class OrganoleptikController extends Controller
{
    public function index(Request $request){

        $list = DB::connection('sqlsrv2')->table('v_data_header')
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();
        $header=NULL;

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header
        ]);
    }

    public function organoleptik(Request $request){

        $id_ppk = request()->segment(3);
        $list = DB::connection('sqlsrv2')->table('v_data_header')
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        $header = DB::connection('sqlsrv2')->table('v_data_header')
            ->where('id_ppk',$id_ppk)
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        $check = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->select('*')
            ->get();

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check'=>$check
        ]);
    }

    public function submit(Request $request){

        $id_ppk = request()->segment(3);

        organoleptik::insert([
            "id_ppk"=> $id_ppk,
            "A91"=>$request->A91,
            "A92"=>$request->A92,
            "A93"=>$request->A93,
            "A94"=>$request->A94,
            "A95"=>$request->A95,
        ]);


        // organoleptik::where('id_ppk', $id_ppk)->update([
        //     "id_ppk"=> $id_ppk,
        //     "data"=>$request->A91
        // ]);
        return redirect('/admin/manage')->with('success');
    }
}
