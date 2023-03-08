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
            ->orderBy('id_ppk','desc')
            ->select('*')
            ->get();
        //dd($check);

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            
        ]);
    }

    public function submit(Request $request){

        $id_ppk = request()->segment(3);

        $ada = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->select('*')
            ->get();

        if(count($ada) > 0){
            organoleptik::where('id_ppk', $id_ppk)->update([
                "A91"=>$request->A91,
                "A92"=>$request->A92,
                "A93"=>$request->A93,
                "A94"=>$request->A94,
                "A95"=>$request->A95,
                "A96"=>$request->A96,
                "A97"=>$request->A97,
                "A98"=>$request->A98,
                "A99"=>$request->A99,
                "A910"=>$request->A910,
                "A911"=>$request->A911,
                "A912"=>$request->A912,
                "A913"=>$request->A913,
                "A914"=>$request->A914,
                "A915"=>$request->A915,
                "A916"=>$request->A916,
                "A917"=>$request->A917,
                "A918"=>$request->A918,
                "A919"=>$request->A919,
                "A920"=>$request->A920,
                "A921"=>$request->A921,
                "A922"=>$request->A922,
                "A923"=>$request->A923,
                "A924"=>$request->A924
                 ]);
        }
        else{
            organoleptik::insert([
                "id_ppk"=> $id_ppk,
                "A91"=>$request->A91,
                "A92"=>$request->A92,
                "A93"=>$request->A93,
                "A94"=>$request->A94,
                "A95"=>$request->A95,
                "A96"=>$request->A96,
                "A97"=>$request->A97,
                "A98"=>$request->A98,
                "A99"=>$request->A99,
                "A910"=>$request->A910,
                "A911"=>$request->A911,
                "A912"=>$request->A912,
                "A913"=>$request->A913,
                "A914"=>$request->A914,
                "A915"=>$request->A915,
                "A916"=>$request->A916,
                "A917"=>$request->A917,
                "A918"=>$request->A918,
                "A919"=>$request->A919,
                "A920"=>$request->A920,
                "A921"=>$request->A921,
                "A922"=>$request->A922,
                "A923"=>$request->A923,
                "A924"=>$request->A924
            ]);
        }

        

        // $data = [];
        // for ($i=1; $i<=24; $i++) {
        //     $data["A9".$i] = $request->{"A9".$i};
        // }
    
        // organoleptik::insert([
        //     "id_ppk"=> $id_ppk,
        //     $data
        // ]);


        
        // organoleptik::where('id_ppk', $id_ppk)->update([
        //     "id_ppk"=> $id_ppk,
        //     "data"=>$request->A91
        // ]);
        return redirect('/admin/organoleptik')->with('berhasilSimpan','Data berhasil disimpan');
    }

    public function reset(Request $request){

        $id_ppk = request()->segment(3);

        $ada = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->select('*')
            ->get();

        if(count($ada) > 0){
            organoleptik::where('id_ppk', $id_ppk)->delete();

        }
        return redirect('/admin/organoleptik/'.$id_ppk);
    }
}
