<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use App\Models\organoleptik;
use App\Models\parameter;
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
        
        // $jenis='';

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            'id_ppk'=>$id_ppk,
            // 'jenis'=>$jenis
        ]);
    }

    public function NilaiOrganoleptik(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);

        $list = DB::connection('sqlsrv2')->table('v_data_header')
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        $header = DB::connection('sqlsrv2')->table('v_data_header')
            ->where('id_ppk',$id_ppk)
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        // $jumlah = DB::connection('sqlsrv2')->table('parameter')
        //     ->where('jenis', $jenis)
        //     ->where(function($query) {
        //         for($i = 1; $i <= 50; $i++) {
        //             $query->where('parameter'.$i, '!=', NULL);
        //         }
        //     })
        //     ->select('*')
        //     ->get();

        $jumlah=0;
        for($i = 1; $i <= 50; $i++) {
            $hitung = DB::connection('sqlsrv2')->table('parameter')
                ->where('jenis', $jenis)
                ->where('parameter'.$i, '!=', NULL)
                ->select('*')
                ->get();
            if(count($hitung) > 0){
                $jumlah=$jumlah+1;
            }
        }

        $check = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->orderBy('id_ppk','desc')
            ->select('*')
            ->get();

        $parameter = DB::connection('sqlsrv2')->table('parameter')
        ->where('jenis',$jenis)
        ->select('*')
        ->get();

        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            'jenis'=>$jenis,
            'id_ppk'=>$id_ppk,
            'jumlah'=>$jumlah,
            'parameter'=>$parameter
            
        ]);
    }

    public function submit(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);

        $ada = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->select('*')
            ->get();

        if(count($ada) > 0){
            organoleptik::where('id_ppk', $id_ppk)->where('jenis', $jenis)->update([
                "petugas"=>$request->petugas,
                "a1x1"=>$request->a1x1, "a1x2"=>$request->a1x2, "a1x3"=>$request->a1x3, "a1x4"=>$request->a1x4, "a1x5"=>$request->a1x5, "a1x6"=>$request->a1x6, "a1x7"=>$request->a1x7, "a1x8"=>$request->a1x8, "a1x9"=>$request->a1x9, "a1x10"=>$request->a1x10, "a1x11"=>$request->a1x11, "a1x12"=>$request->a1x12, "a1x13"=>$request->a1x13, "a1x14"=>$request->a1x14, "a1x15"=>$request->a1x15, "a1x16"=>$request->a1x16, "a1x17"=>$request->a1x17, "a1x18"=>$request->a1x18, "a1x19"=>$request->a1x19, "a1x20"=>$request->a1x20, "a1x21"=>$request->a1x21, "a1x22"=>$request->a1x22, "a1x23"=>$request->a1x23, "a1x24"=>$request->a1x24,
                "a2x1"=>$request->a2x1, "a2x2"=>$request->a2x2, "a2x3"=>$request->a2x3, "a2x4"=>$request->a2x4, "a2x5"=>$request->a2x5, "a2x6"=>$request->a2x6, "a2x7"=>$request->a2x7, "a2x8"=>$request->a2x8, "a2x9"=>$request->a2x9, "a2x10"=>$request->a2x10, "a2x11"=>$request->a2x11, "a2x12"=>$request->a2x12, "a2x13"=>$request->a2x13, "a2x14"=>$request->a2x14, "a2x15"=>$request->a2x15, "a2x16"=>$request->a2x16, "a2x17"=>$request->a2x17, "a2x18"=>$request->a2x18, "a2x19"=>$request->a2x19, "a2x20"=>$request->a2x20, "a2x21"=>$request->a2x21, "a2x22"=>$request->a2x22, "a2x23"=>$request->a2x23, "a2x24"=>$request->a2x24,
                "a3x1"=>$request->a3x1, "a3x2"=>$request->a3x2, "a3x3"=>$request->a3x3, "a3x4"=>$request->a3x4, "a3x5"=>$request->a3x5, "a3x6"=>$request->a3x6, "a3x7"=>$request->a3x7, "a3x8"=>$request->a3x8, "a3x9"=>$request->a3x9, "a3x10"=>$request->a3x10, "a3x11"=>$request->a3x11, "a3x12"=>$request->a3x12, "a3x13"=>$request->a3x13, "a3x14"=>$request->a3x14, "a3x15"=>$request->a3x15, "a3x16"=>$request->a3x16, "a3x17"=>$request->a3x17, "a3x18"=>$request->a3x18, "a3x19"=>$request->a3x19, "a3x20"=>$request->a3x20, "a3x21"=>$request->a3x21, "a3x22"=>$request->a3x22, "a3x23"=>$request->a3x23, "a3x24"=>$request->a3x24,
                "a4x1"=>$request->a4x1, "a4x2"=>$request->a4x2, "a4x3"=>$request->a4x3, "a4x4"=>$request->a4x4, "a4x5"=>$request->a4x5, "a4x6"=>$request->a4x6, "a4x7"=>$request->a4x7, "a4x8"=>$request->a4x8, "a4x9"=>$request->a4x9, "a4x10"=>$request->a4x10, "a4x11"=>$request->a4x11, "a4x12"=>$request->a4x12, "a4x13"=>$request->a4x13, "a4x14"=>$request->a4x14, "a4x15"=>$request->a4x15, "a4x16"=>$request->a4x16, "a4x17"=>$request->a4x17, "a4x18"=>$request->a4x18, "a4x19"=>$request->a4x19, "a4x20"=>$request->a4x20, "a4x21"=>$request->a4x21, "a4x22"=>$request->a4x22, "a4x23"=>$request->a4x23, "a4x24"=>$request->a4x24,
                "a5x1"=>$request->a5x1, "a5x2"=>$request->a5x2, "a5x3"=>$request->a5x3, "a5x4"=>$request->a5x4, "a5x5"=>$request->a5x5, "a5x6"=>$request->a5x6, "a5x7"=>$request->a5x7, "a5x8"=>$request->a5x8, "a5x9"=>$request->a5x9, "a5x10"=>$request->a5x10, "a5x11"=>$request->a5x11, "a5x12"=>$request->a5x12, "a5x13"=>$request->a5x13, "a5x14"=>$request->a5x14, "a5x15"=>$request->a5x15, "a5x16"=>$request->a5x16, "a5x17"=>$request->a5x17, "a5x18"=>$request->a5x18, "a5x19"=>$request->a5x19, "a5x20"=>$request->a5x20, "a5x21"=>$request->a5x21, "a5x22"=>$request->a5x22, "a5x23"=>$request->a5x23, "a5x24"=>$request->a5x24,
                "a6x1"=>$request->a6x1, "a6x2"=>$request->a6x2, "a6x3"=>$request->a6x3, "a6x4"=>$request->a6x4, "a6x5"=>$request->a6x5, "a6x6"=>$request->a6x6, "a6x7"=>$request->a6x7, "a6x8"=>$request->a6x8, "a6x9"=>$request->a6x9, "a6x10"=>$request->a6x10, "a6x11"=>$request->a6x11, "a6x12"=>$request->a6x12, "a6x13"=>$request->a6x13, "a6x14"=>$request->a6x14, "a6x15"=>$request->a6x15, "a6x16"=>$request->a6x16, "a6x17"=>$request->a6x17, "a6x18"=>$request->a6x18, "a6x19"=>$request->a6x19, "a6x20"=>$request->a6x20, "a6x21"=>$request->a6x21, "a6x22"=>$request->a6x22, "a6x23"=>$request->a6x23, "a6x24"=>$request->a6x24,
                "a7x1"=>$request->a7x1, "a7x2"=>$request->a7x2, "a7x3"=>$request->a7x3, "a7x4"=>$request->a7x4, "a7x5"=>$request->a7x5, "a7x6"=>$request->a7x6, "a7x7"=>$request->a7x7, "a7x8"=>$request->a7x8, "a7x9"=>$request->a7x9, "a7x10"=>$request->a7x10, "a7x11"=>$request->a7x11, "a7x12"=>$request->a7x12, "a7x13"=>$request->a7x13, "a7x14"=>$request->a7x14, "a7x15"=>$request->a7x15, "a7x16"=>$request->a7x16, "a7x17"=>$request->a7x17, "a7x18"=>$request->a7x18, "a7x19"=>$request->a7x19, "a7x20"=>$request->a7x20, "a7x21"=>$request->a7x21, "a7x22"=>$request->a7x22, "a7x23"=>$request->a7x23, "a7x24"=>$request->a7x24,
                "a8x1"=>$request->a8x1, "a8x2"=>$request->a8x2, "a8x3"=>$request->a8x3, "a8x4"=>$request->a8x4, "a8x5"=>$request->a8x5, "a8x6"=>$request->a8x6, "a8x7"=>$request->a8x7, "a8x8"=>$request->a8x8, "a8x9"=>$request->a8x9, "a8x10"=>$request->a8x10, "a8x11"=>$request->a8x11, "a8x12"=>$request->a8x12, "a8x13"=>$request->a8x13, "a8x14"=>$request->a8x14, "a8x15"=>$request->a8x15, "a8x16"=>$request->a8x16, "a8x17"=>$request->a8x17, "a8x18"=>$request->a8x18, "a8x19"=>$request->a8x19, "a8x20"=>$request->a8x20, "a8x21"=>$request->a8x21, "a8x22"=>$request->a8x22, "a8x23"=>$request->a8x23, "a8x24"=>$request->a8x24,
                "a9x1"=>$request->a9x1, "a9x2"=>$request->a9x2, "a9x3"=>$request->a9x3, "a9x4"=>$request->a9x4, "a9x5"=>$request->a9x5, "a9x6"=>$request->a9x6, "a9x7"=>$request->a9x7, "a9x8"=>$request->a9x8, "a9x9"=>$request->a9x9, "a9x10"=>$request->a9x10, "a9x11"=>$request->a9x11, "a9x12"=>$request->a9x12, "a9x13"=>$request->a9x13, "a9x14"=>$request->a9x14, "a9x15"=>$request->a9x15, "a9x16"=>$request->a9x16, "a9x17"=>$request->a9x17, "a9x18"=>$request->a9x18, "a9x19"=>$request->a9x19, "a9x20"=>$request->a9x20, "a9x21"=>$request->a9x21, "a9x22"=>$request->a9x22, "a9x23"=>$request->a9x23, "a9x24"=>$request->a9x24,
                "a10x1"=>$request->a10x1, "a10x2"=>$request->a10x2, "a10x3"=>$request->a10x3, "a10x4"=>$request->a10x4, "a10x5"=>$request->a10x5, "a10x6"=>$request->a10x6, "a10x7"=>$request->a10x7, "a10x8"=>$request->a10x8, "a10x9"=>$request->a10x9, "a10x10"=>$request->a10x10, "a10x11"=>$request->a10x11, "a10x12"=>$request->a10x12, "a10x13"=>$request->a10x13, "a10x14"=>$request->a10x14, "a10x15"=>$request->a10x15, "a10x16"=>$request->a10x16, "a10x17"=>$request->a10x17, "a10x18"=>$request->a10x18, "a10x19"=>$request->a10x19, "a10x20"=>$request->a10x20, "a10x21"=>$request->a10x21, "a10x22"=>$request->a10x22, "a10x23"=>$request->a10x23, "a10x24"=>$request->a10x24,
                "a11x1"=>$request->a11x1, "a11x2"=>$request->a11x2, "a11x3"=>$request->a11x3, "a11x4"=>$request->a11x4, "a11x5"=>$request->a11x5, "a11x6"=>$request->a11x6, "a11x7"=>$request->a11x7, "a11x8"=>$request->a11x8, "a11x9"=>$request->a11x9, "a11x10"=>$request->a11x10, "a11x11"=>$request->a11x11, "a11x12"=>$request->a11x12, "a11x13"=>$request->a11x13, "a11x14"=>$request->a11x14, "a11x15"=>$request->a11x15, "a11x16"=>$request->a11x16, "a11x17"=>$request->a11x17, "a11x18"=>$request->a11x18, "a11x19"=>$request->a11x19, "a11x20"=>$request->a11x20, "a11x21"=>$request->a11x21, "a11x22"=>$request->a11x22, "a11x23"=>$request->a11x23, "a11x24"=>$request->a11x24,
                "a12x1"=>$request->a12x1, "a12x2"=>$request->a12x2, "a12x3"=>$request->a12x3, "a12x4"=>$request->a12x4, "a12x5"=>$request->a12x5, "a12x6"=>$request->a12x6, "a12x7"=>$request->a12x7, "a12x8"=>$request->a12x8, "a12x9"=>$request->a12x9, "a12x10"=>$request->a12x10, "a12x11"=>$request->a12x11, "a12x12"=>$request->a12x12, "a12x13"=>$request->a12x13, "a12x14"=>$request->a12x14, "a12x15"=>$request->a12x15, "a12x16"=>$request->a12x16, "a12x17"=>$request->a12x17, "a12x18"=>$request->a12x18, "a12x19"=>$request->a12x19, "a12x20"=>$request->a12x20, "a12x21"=>$request->a12x21, "a12x22"=>$request->a12x22, "a12x23"=>$request->a12x23, "a12x24"=>$request->a12x24,
                "a13x1"=>$request->a13x1, "a13x2"=>$request->a13x2, "a13x3"=>$request->a13x3, "a13x4"=>$request->a13x4, "a13x5"=>$request->a13x5, "a13x6"=>$request->a13x6, "a13x7"=>$request->a13x7, "a13x8"=>$request->a13x8, "a13x9"=>$request->a13x9, "a13x10"=>$request->a13x10, "a13x11"=>$request->a13x11, "a13x12"=>$request->a13x12, "a13x13"=>$request->a13x13, "a13x14"=>$request->a13x14, "a13x15"=>$request->a13x15, "a13x16"=>$request->a13x16, "a13x17"=>$request->a13x17, "a13x18"=>$request->a13x18, "a13x19"=>$request->a13x19, "a13x20"=>$request->a13x20, "a13x21"=>$request->a13x21, "a13x22"=>$request->a13x22, "a13x23"=>$request->a13x23, "a13x24"=>$request->a13x24,
                "a14x1"=>$request->a14x1, "a14x2"=>$request->a14x2, "a14x3"=>$request->a14x3, "a14x4"=>$request->a14x4, "a14x5"=>$request->a14x5, "a14x6"=>$request->a14x6, "a14x7"=>$request->a14x7, "a14x8"=>$request->a14x8, "a14x9"=>$request->a14x9, "a14x10"=>$request->a14x10, "a14x11"=>$request->a14x11, "a14x12"=>$request->a14x12, "a14x13"=>$request->a14x13, "a14x14"=>$request->a14x14, "a14x15"=>$request->a14x15, "a14x16"=>$request->a14x16, "a14x17"=>$request->a14x17, "a14x18"=>$request->a14x18, "a14x19"=>$request->a14x19, "a14x20"=>$request->a14x20, "a14x21"=>$request->a14x21, "a14x22"=>$request->a14x22, "a14x23"=>$request->a14x23, "a14x24"=>$request->a14x24,
                "a15x1"=>$request->a15x1, "a15x2"=>$request->a15x2, "a15x3"=>$request->a15x3, "a15x4"=>$request->a15x4, "a15x5"=>$request->a15x5, "a15x6"=>$request->a15x6, "a15x7"=>$request->a15x7, "a15x8"=>$request->a15x8, "a15x9"=>$request->a15x9, "a15x10"=>$request->a15x10, "a15x11"=>$request->a15x11, "a15x12"=>$request->a15x12, "a15x13"=>$request->a15x13, "a15x14"=>$request->a15x14, "a15x15"=>$request->a15x15, "a15x16"=>$request->a15x16, "a15x17"=>$request->a15x17, "a15x18"=>$request->a15x18, "a15x19"=>$request->a15x19, "a15x20"=>$request->a15x20, "a15x21"=>$request->a15x21, "a15x22"=>$request->a15x22, "a15x23"=>$request->a15x23, "a15x24"=>$request->a15x24,
                "a16x1"=>$request->a16x1, "a16x2"=>$request->a16x2, "a16x3"=>$request->a16x3, "a16x4"=>$request->a16x4, "a16x5"=>$request->a16x5, "a16x6"=>$request->a16x6, "a16x7"=>$request->a16x7, "a16x8"=>$request->a16x8, "a16x9"=>$request->a16x9, "a16x10"=>$request->a16x10, "a16x11"=>$request->a16x11, "a16x12"=>$request->a16x12, "a16x13"=>$request->a16x13, "a16x14"=>$request->a16x14, "a16x15"=>$request->a16x15, "a16x16"=>$request->a16x16, "a16x17"=>$request->a16x17, "a16x18"=>$request->a16x18, "a16x19"=>$request->a16x19, "a16x20"=>$request->a16x20, "a16x21"=>$request->a16x21, "a16x22"=>$request->a16x22, "a16x23"=>$request->a16x23, "a16x24"=>$request->a16x24,
                "a17x1"=>$request->a17x1, "a17x2"=>$request->a17x2, "a17x3"=>$request->a17x3, "a17x4"=>$request->a17x4, "a17x5"=>$request->a17x5, "a17x6"=>$request->a17x6, "a17x7"=>$request->a17x7, "a17x8"=>$request->a17x8, "a17x9"=>$request->a17x9, "a17x10"=>$request->a17x10, "a17x11"=>$request->a17x11, "a17x12"=>$request->a17x12, "a17x13"=>$request->a17x13, "a17x14"=>$request->a17x14, "a17x15"=>$request->a17x15, "a17x16"=>$request->a17x16, "a17x17"=>$request->a17x17, "a17x18"=>$request->a17x18, "a17x19"=>$request->a17x19, "a17x20"=>$request->a17x20, "a17x21"=>$request->a17x21, "a17x22"=>$request->a17x22, "a17x23"=>$request->a17x23, "a17x24"=>$request->a17x24,
                "a18x1"=>$request->a18x1, "a18x2"=>$request->a18x2, "a18x3"=>$request->a18x3, "a18x4"=>$request->a18x4, "a18x5"=>$request->a18x5, "a18x6"=>$request->a18x6, "a18x7"=>$request->a18x7, "a18x8"=>$request->a18x8, "a18x9"=>$request->a18x9, "a18x10"=>$request->a18x10, "a18x11"=>$request->a18x11, "a18x12"=>$request->a18x12, "a18x13"=>$request->a18x13, "a18x14"=>$request->a18x14, "a18x15"=>$request->a18x15, "a18x16"=>$request->a18x16, "a18x17"=>$request->a18x17, "a18x18"=>$request->a18x18, "a18x19"=>$request->a18x19, "a18x20"=>$request->a18x20, "a18x21"=>$request->a18x21, "a18x22"=>$request->a18x22, "a18x23"=>$request->a18x23, "a18x24"=>$request->a18x24,
                "a19x1"=>$request->a19x1, "a19x2"=>$request->a19x2, "a19x3"=>$request->a19x3, "a19x4"=>$request->a19x4, "a19x5"=>$request->a19x5, "a19x6"=>$request->a19x6, "a19x7"=>$request->a19x7, "a19x8"=>$request->a19x8, "a19x9"=>$request->a19x9, "a19x10"=>$request->a19x10, "a19x11"=>$request->a19x11, "a19x12"=>$request->a19x12, "a19x13"=>$request->a19x13, "a19x14"=>$request->a19x14, "a19x15"=>$request->a19x15, "a19x16"=>$request->a19x16, "a19x17"=>$request->a19x17, "a19x18"=>$request->a19x18, "a19x19"=>$request->a19x19, "a19x20"=>$request->a19x20, "a19x21"=>$request->a19x21, "a19x22"=>$request->a19x22, "a19x23"=>$request->a19x23, "a19x24"=>$request->a19x24,
                "a20x1"=>$request->a20x1, "a20x2"=>$request->a20x2, "a20x3"=>$request->a20x3, "a20x4"=>$request->a20x4, "a20x5"=>$request->a20x5, "a20x6"=>$request->a20x6, "a20x7"=>$request->a20x7, "a20x8"=>$request->a20x8, "a20x9"=>$request->a20x9, "a20x10"=>$request->a20x10, "a20x11"=>$request->a20x11, "a20x12"=>$request->a20x12, "a20x13"=>$request->a20x13, "a20x14"=>$request->a20x14, "a20x15"=>$request->a20x15, "a20x16"=>$request->a20x16, "a20x17"=>$request->a20x17, "a20x18"=>$request->a20x18, "a20x19"=>$request->a20x19, "a20x20"=>$request->a20x20, "a20x21"=>$request->a20x21, "a20x22"=>$request->a20x22, "a20x23"=>$request->a20x23, "a20x24"=>$request->a20x24,
                "a21x1"=>$request->a21x1, "a21x2"=>$request->a21x2, "a21x3"=>$request->a21x3, "a21x4"=>$request->a21x4, "a21x5"=>$request->a21x5, "a21x6"=>$request->a21x6, "a21x7"=>$request->a21x7, "a21x8"=>$request->a21x8, "a21x9"=>$request->a21x9, "a21x10"=>$request->a21x10, "a21x11"=>$request->a21x11, "a21x12"=>$request->a21x12, "a21x13"=>$request->a21x13, "a21x14"=>$request->a21x14, "a21x15"=>$request->a21x15, "a21x16"=>$request->a21x16, "a21x17"=>$request->a21x17, "a21x18"=>$request->a21x18, "a21x19"=>$request->a21x19, "a21x20"=>$request->a21x20, "a21x21"=>$request->a21x21, "a21x22"=>$request->a21x22, "a21x23"=>$request->a21x23, "a21x24"=>$request->a21x24,
                "a22x1"=>$request->a22x1, "a22x2"=>$request->a22x2, "a22x3"=>$request->a22x3, "a22x4"=>$request->a22x4, "a22x5"=>$request->a22x5, "a22x6"=>$request->a22x6, "a22x7"=>$request->a22x7, "a22x8"=>$request->a22x8, "a22x9"=>$request->a22x9, "a22x10"=>$request->a22x10, "a22x11"=>$request->a22x11, "a22x12"=>$request->a22x12, "a22x13"=>$request->a22x13, "a22x14"=>$request->a22x14, "a22x15"=>$request->a22x15, "a22x16"=>$request->a22x16, "a22x17"=>$request->a22x17, "a22x18"=>$request->a22x18, "a22x19"=>$request->a22x19, "a22x20"=>$request->a22x20, "a22x21"=>$request->a22x21, "a22x22"=>$request->a22x22, "a22x23"=>$request->a22x23, "a22x24"=>$request->a22x24,
                "a23x1"=>$request->a23x1, "a23x2"=>$request->a23x2, "a23x3"=>$request->a23x3, "a23x4"=>$request->a23x4, "a23x5"=>$request->a23x5, "a23x6"=>$request->a23x6, "a23x7"=>$request->a23x7, "a23x8"=>$request->a23x8, "a23x9"=>$request->a23x9, "a23x10"=>$request->a23x10, "a23x11"=>$request->a23x11, "a23x12"=>$request->a23x12, "a23x13"=>$request->a23x13, "a23x14"=>$request->a23x14, "a23x15"=>$request->a23x15, "a23x16"=>$request->a23x16, "a23x17"=>$request->a23x17, "a23x18"=>$request->a23x18, "a23x19"=>$request->a23x19, "a23x20"=>$request->a23x20, "a23x21"=>$request->a23x21, "a23x22"=>$request->a23x22, "a23x23"=>$request->a23x23, "a23x24"=>$request->a23x24,
                "a24x1"=>$request->a24x1, "a24x2"=>$request->a24x2, "a24x3"=>$request->a24x3, "a24x4"=>$request->a24x4, "a24x5"=>$request->a24x5, "a24x6"=>$request->a24x6, "a24x7"=>$request->a24x7, "a24x8"=>$request->a24x8, "a24x9"=>$request->a24x9, "a24x10"=>$request->a24x10, "a24x11"=>$request->a24x11, "a24x12"=>$request->a24x12, "a24x13"=>$request->a24x13, "a24x14"=>$request->a24x14, "a24x15"=>$request->a24x15, "a24x16"=>$request->a24x16, "a24x17"=>$request->a24x17, "a24x18"=>$request->a24x18, "a24x19"=>$request->a24x19, "a24x20"=>$request->a24x20, "a24x21"=>$request->a24x21, "a24x22"=>$request->a24x22, "a24x23"=>$request->a24x23, "a24x24"=>$request->a24x24,
                "a25x1"=>$request->a25x1, "a25x2"=>$request->a25x2, "a25x3"=>$request->a25x3, "a25x4"=>$request->a25x4, "a25x5"=>$request->a25x5, "a25x6"=>$request->a25x6, "a25x7"=>$request->a25x7, "a25x8"=>$request->a25x8, "a25x9"=>$request->a25x9, "a25x10"=>$request->a25x10, "a25x11"=>$request->a25x11, "a25x12"=>$request->a25x12, "a25x13"=>$request->a25x13, "a25x14"=>$request->a25x14, "a25x15"=>$request->a25x15, "a25x16"=>$request->a25x16, "a25x17"=>$request->a25x17, "a25x18"=>$request->a25x18, "a25x19"=>$request->a25x19, "a25x20"=>$request->a25x20, "a25x21"=>$request->a25x21, "a25x22"=>$request->a25x22, "a25x23"=>$request->a25x23, "a25x24"=>$request->a25x24,
                "a26x1"=>$request->a26x1, "a26x2"=>$request->a26x2, "a26x3"=>$request->a26x3, "a26x4"=>$request->a26x4, "a26x5"=>$request->a26x5, "a26x6"=>$request->a26x6, "a26x7"=>$request->a26x7, "a26x8"=>$request->a26x8, "a26x9"=>$request->a26x9, "a26x10"=>$request->a26x10, "a26x11"=>$request->a26x11, "a26x12"=>$request->a26x12, "a26x13"=>$request->a26x13, "a26x14"=>$request->a26x14, "a26x15"=>$request->a26x15, "a26x16"=>$request->a26x16, "a26x17"=>$request->a26x17, "a26x18"=>$request->a26x18, "a26x19"=>$request->a26x19, "a26x20"=>$request->a26x20, "a26x21"=>$request->a26x21, "a26x22"=>$request->a26x22, "a26x23"=>$request->a26x23, "a26x24"=>$request->a26x24,
                "a27x1"=>$request->a27x1, "a27x2"=>$request->a27x2, "a27x3"=>$request->a27x3, "a27x4"=>$request->a27x4, "a27x5"=>$request->a27x5, "a27x6"=>$request->a27x6, "a27x7"=>$request->a27x7, "a27x8"=>$request->a27x8, "a27x9"=>$request->a27x9, "a27x10"=>$request->a27x10, "a27x11"=>$request->a27x11, "a27x12"=>$request->a27x12, "a27x13"=>$request->a27x13, "a27x14"=>$request->a27x14, "a27x15"=>$request->a27x15, "a27x16"=>$request->a27x16, "a27x17"=>$request->a27x17, "a27x18"=>$request->a27x18, "a27x19"=>$request->a27x19, "a27x20"=>$request->a27x20, "a27x21"=>$request->a27x21, "a27x22"=>$request->a27x22, "a27x23"=>$request->a27x23, "a27x24"=>$request->a27x24,
                "a28x1"=>$request->a28x1, "a28x2"=>$request->a28x2, "a28x3"=>$request->a28x3, "a28x4"=>$request->a28x4, "a28x5"=>$request->a28x5, "a28x6"=>$request->a28x6, "a28x7"=>$request->a28x7, "a28x8"=>$request->a28x8, "a28x9"=>$request->a28x9, "a28x10"=>$request->a28x10, "a28x11"=>$request->a28x11, "a28x12"=>$request->a28x12, "a28x13"=>$request->a28x13, "a28x14"=>$request->a28x14, "a28x15"=>$request->a28x15, "a28x16"=>$request->a28x16, "a28x17"=>$request->a28x17, "a28x18"=>$request->a28x18, "a28x19"=>$request->a28x19, "a28x20"=>$request->a28x20, "a28x21"=>$request->a28x21, "a28x22"=>$request->a28x22, "a28x23"=>$request->a28x23, "a28x24"=>$request->a28x24,
                "a29x1"=>$request->a29x1, "a29x2"=>$request->a29x2, "a29x3"=>$request->a29x3, "a29x4"=>$request->a29x4, "a29x5"=>$request->a29x5, "a29x6"=>$request->a29x6, "a29x7"=>$request->a29x7, "a29x8"=>$request->a29x8, "a29x9"=>$request->a29x9, "a29x10"=>$request->a29x10, "a29x11"=>$request->a29x11, "a29x12"=>$request->a29x12, "a29x13"=>$request->a29x13, "a29x14"=>$request->a29x14, "a29x15"=>$request->a29x15, "a29x16"=>$request->a29x16, "a29x17"=>$request->a29x17, "a29x18"=>$request->a29x18, "a29x19"=>$request->a29x19, "a29x20"=>$request->a29x20, "a29x21"=>$request->a29x21, "a29x22"=>$request->a29x22, "a29x23"=>$request->a29x23, "a29x24"=>$request->a29x24,
                "a30x1"=>$request->a30x1, "a30x2"=>$request->a30x2, "a30x3"=>$request->a30x3, "a30x4"=>$request->a30x4, "a30x5"=>$request->a30x5, "a30x6"=>$request->a30x6, "a30x7"=>$request->a30x7, "a30x8"=>$request->a30x8, "a30x9"=>$request->a30x9, "a30x10"=>$request->a30x10, "a30x11"=>$request->a30x11, "a30x12"=>$request->a30x12, "a30x13"=>$request->a30x13, "a30x14"=>$request->a30x14, "a30x15"=>$request->a30x15, "a30x16"=>$request->a30x16, "a30x17"=>$request->a30x17, "a30x18"=>$request->a30x18, "a30x19"=>$request->a30x19, "a30x20"=>$request->a30x20, "a30x21"=>$request->a30x21, "a30x22"=>$request->a30x22, "a30x23"=>$request->a30x23, "a30x24"=>$request->a30x24,
                 ]);

        }
        else{
            organoleptik::insert([
                "id_ppk"=> $id_ppk,"jenis"=>$jenis, "petugas"=>$request->petugas,
                "a1x1"=>$request->a1x1, "a1x2"=>$request->a1x2, "a1x3"=>$request->a1x3, "a1x4"=>$request->a1x4, "a1x5"=>$request->a1x5, "a1x6"=>$request->a1x6, "a1x7"=>$request->a1x7, "a1x8"=>$request->a1x8, "a1x9"=>$request->a1x9, "a1x10"=>$request->a1x10, "a1x11"=>$request->a1x11, "a1x12"=>$request->a1x12, "a1x13"=>$request->a1x13, "a1x14"=>$request->a1x14, "a1x15"=>$request->a1x15, "a1x16"=>$request->a1x16, "a1x17"=>$request->a1x17, "a1x18"=>$request->a1x18, "a1x19"=>$request->a1x19, "a1x20"=>$request->a1x20, "a1x21"=>$request->a1x21, "a1x22"=>$request->a1x22, "a1x23"=>$request->a1x23, "a1x24"=>$request->a1x24,
                "a2x1"=>$request->a2x1, "a2x2"=>$request->a2x2, "a2x3"=>$request->a2x3, "a2x4"=>$request->a2x4, "a2x5"=>$request->a2x5, "a2x6"=>$request->a2x6, "a2x7"=>$request->a2x7, "a2x8"=>$request->a2x8, "a2x9"=>$request->a2x9, "a2x10"=>$request->a2x10, "a2x11"=>$request->a2x11, "a2x12"=>$request->a2x12, "a2x13"=>$request->a2x13, "a2x14"=>$request->a2x14, "a2x15"=>$request->a2x15, "a2x16"=>$request->a2x16, "a2x17"=>$request->a2x17, "a2x18"=>$request->a2x18, "a2x19"=>$request->a2x19, "a2x20"=>$request->a2x20, "a2x21"=>$request->a2x21, "a2x22"=>$request->a2x22, "a2x23"=>$request->a2x23, "a2x24"=>$request->a2x24,
                "a3x1"=>$request->a3x1, "a3x2"=>$request->a3x2, "a3x3"=>$request->a3x3, "a3x4"=>$request->a3x4, "a3x5"=>$request->a3x5, "a3x6"=>$request->a3x6, "a3x7"=>$request->a3x7, "a3x8"=>$request->a3x8, "a3x9"=>$request->a3x9, "a3x10"=>$request->a3x10, "a3x11"=>$request->a3x11, "a3x12"=>$request->a3x12, "a3x13"=>$request->a3x13, "a3x14"=>$request->a3x14, "a3x15"=>$request->a3x15, "a3x16"=>$request->a3x16, "a3x17"=>$request->a3x17, "a3x18"=>$request->a3x18, "a3x19"=>$request->a3x19, "a3x20"=>$request->a3x20, "a3x21"=>$request->a3x21, "a3x22"=>$request->a3x22, "a3x23"=>$request->a3x23, "a3x24"=>$request->a3x24,
                "a4x1"=>$request->a4x1, "a4x2"=>$request->a4x2, "a4x3"=>$request->a4x3, "a4x4"=>$request->a4x4, "a4x5"=>$request->a4x5, "a4x6"=>$request->a4x6, "a4x7"=>$request->a4x7, "a4x8"=>$request->a4x8, "a4x9"=>$request->a4x9, "a4x10"=>$request->a4x10, "a4x11"=>$request->a4x11, "a4x12"=>$request->a4x12, "a4x13"=>$request->a4x13, "a4x14"=>$request->a4x14, "a4x15"=>$request->a4x15, "a4x16"=>$request->a4x16, "a4x17"=>$request->a4x17, "a4x18"=>$request->a4x18, "a4x19"=>$request->a4x19, "a4x20"=>$request->a4x20, "a4x21"=>$request->a4x21, "a4x22"=>$request->a4x22, "a4x23"=>$request->a4x23, "a4x24"=>$request->a4x24,
                "a5x1"=>$request->a5x1, "a5x2"=>$request->a5x2, "a5x3"=>$request->a5x3, "a5x4"=>$request->a5x4, "a5x5"=>$request->a5x5, "a5x6"=>$request->a5x6, "a5x7"=>$request->a5x7, "a5x8"=>$request->a5x8, "a5x9"=>$request->a5x9, "a5x10"=>$request->a5x10, "a5x11"=>$request->a5x11, "a5x12"=>$request->a5x12, "a5x13"=>$request->a5x13, "a5x14"=>$request->a5x14, "a5x15"=>$request->a5x15, "a5x16"=>$request->a5x16, "a5x17"=>$request->a5x17, "a5x18"=>$request->a5x18, "a5x19"=>$request->a5x19, "a5x20"=>$request->a5x20, "a5x21"=>$request->a5x21, "a5x22"=>$request->a5x22, "a5x23"=>$request->a5x23, "a5x24"=>$request->a5x24,
                "a6x1"=>$request->a6x1, "a6x2"=>$request->a6x2, "a6x3"=>$request->a6x3, "a6x4"=>$request->a6x4, "a6x5"=>$request->a6x5, "a6x6"=>$request->a6x6, "a6x7"=>$request->a6x7, "a6x8"=>$request->a6x8, "a6x9"=>$request->a6x9, "a6x10"=>$request->a6x10, "a6x11"=>$request->a6x11, "a6x12"=>$request->a6x12, "a6x13"=>$request->a6x13, "a6x14"=>$request->a6x14, "a6x15"=>$request->a6x15, "a6x16"=>$request->a6x16, "a6x17"=>$request->a6x17, "a6x18"=>$request->a6x18, "a6x19"=>$request->a6x19, "a6x20"=>$request->a6x20, "a6x21"=>$request->a6x21, "a6x22"=>$request->a6x22, "a6x23"=>$request->a6x23, "a6x24"=>$request->a6x24,
                "a7x1"=>$request->a7x1, "a7x2"=>$request->a7x2, "a7x3"=>$request->a7x3, "a7x4"=>$request->a7x4, "a7x5"=>$request->a7x5, "a7x6"=>$request->a7x6, "a7x7"=>$request->a7x7, "a7x8"=>$request->a7x8, "a7x9"=>$request->a7x9, "a7x10"=>$request->a7x10, "a7x11"=>$request->a7x11, "a7x12"=>$request->a7x12, "a7x13"=>$request->a7x13, "a7x14"=>$request->a7x14, "a7x15"=>$request->a7x15, "a7x16"=>$request->a7x16, "a7x17"=>$request->a7x17, "a7x18"=>$request->a7x18, "a7x19"=>$request->a7x19, "a7x20"=>$request->a7x20, "a7x21"=>$request->a7x21, "a7x22"=>$request->a7x22, "a7x23"=>$request->a7x23, "a7x24"=>$request->a7x24,
                "a8x1"=>$request->a8x1, "a8x2"=>$request->a8x2, "a8x3"=>$request->a8x3, "a8x4"=>$request->a8x4, "a8x5"=>$request->a8x5, "a8x6"=>$request->a8x6, "a8x7"=>$request->a8x7, "a8x8"=>$request->a8x8, "a8x9"=>$request->a8x9, "a8x10"=>$request->a8x10, "a8x11"=>$request->a8x11, "a8x12"=>$request->a8x12, "a8x13"=>$request->a8x13, "a8x14"=>$request->a8x14, "a8x15"=>$request->a8x15, "a8x16"=>$request->a8x16, "a8x17"=>$request->a8x17, "a8x18"=>$request->a8x18, "a8x19"=>$request->a8x19, "a8x20"=>$request->a8x20, "a8x21"=>$request->a8x21, "a8x22"=>$request->a8x22, "a8x23"=>$request->a8x23, "a8x24"=>$request->a8x24,
                "a9x1"=>$request->a9x1, "a9x2"=>$request->a9x2, "a9x3"=>$request->a9x3, "a9x4"=>$request->a9x4, "a9x5"=>$request->a9x5, "a9x6"=>$request->a9x6, "a9x7"=>$request->a9x7, "a9x8"=>$request->a9x8, "a9x9"=>$request->a9x9, "a9x10"=>$request->a9x10, "a9x11"=>$request->a9x11, "a9x12"=>$request->a9x12, "a9x13"=>$request->a9x13, "a9x14"=>$request->a9x14, "a9x15"=>$request->a9x15, "a9x16"=>$request->a9x16, "a9x17"=>$request->a9x17, "a9x18"=>$request->a9x18, "a9x19"=>$request->a9x19, "a9x20"=>$request->a9x20, "a9x21"=>$request->a9x21, "a9x22"=>$request->a9x22, "a9x23"=>$request->a9x23, "a9x24"=>$request->a9x24,
                "a10x1"=>$request->a10x1, "a10x2"=>$request->a10x2, "a10x3"=>$request->a10x3, "a10x4"=>$request->a10x4, "a10x5"=>$request->a10x5, "a10x6"=>$request->a10x6, "a10x7"=>$request->a10x7, "a10x8"=>$request->a10x8, "a10x9"=>$request->a10x9, "a10x10"=>$request->a10x10, "a10x11"=>$request->a10x11, "a10x12"=>$request->a10x12, "a10x13"=>$request->a10x13, "a10x14"=>$request->a10x14, "a10x15"=>$request->a10x15, "a10x16"=>$request->a10x16, "a10x17"=>$request->a10x17, "a10x18"=>$request->a10x18, "a10x19"=>$request->a10x19, "a10x20"=>$request->a10x20, "a10x21"=>$request->a10x21, "a10x22"=>$request->a10x22, "a10x23"=>$request->a10x23, "a10x24"=>$request->a10x24,
                "a11x1"=>$request->a11x1, "a11x2"=>$request->a11x2, "a11x3"=>$request->a11x3, "a11x4"=>$request->a11x4, "a11x5"=>$request->a11x5, "a11x6"=>$request->a11x6, "a11x7"=>$request->a11x7, "a11x8"=>$request->a11x8, "a11x9"=>$request->a11x9, "a11x10"=>$request->a11x10, "a11x11"=>$request->a11x11, "a11x12"=>$request->a11x12, "a11x13"=>$request->a11x13, "a11x14"=>$request->a11x14, "a11x15"=>$request->a11x15, "a11x16"=>$request->a11x16, "a11x17"=>$request->a11x17, "a11x18"=>$request->a11x18, "a11x19"=>$request->a11x19, "a11x20"=>$request->a11x20, "a11x21"=>$request->a11x21, "a11x22"=>$request->a11x22, "a11x23"=>$request->a11x23, "a11x24"=>$request->a11x24,
                "a12x1"=>$request->a12x1, "a12x2"=>$request->a12x2, "a12x3"=>$request->a12x3, "a12x4"=>$request->a12x4, "a12x5"=>$request->a12x5, "a12x6"=>$request->a12x6, "a12x7"=>$request->a12x7, "a12x8"=>$request->a12x8, "a12x9"=>$request->a12x9, "a12x10"=>$request->a12x10, "a12x11"=>$request->a12x11, "a12x12"=>$request->a12x12, "a12x13"=>$request->a12x13, "a12x14"=>$request->a12x14, "a12x15"=>$request->a12x15, "a12x16"=>$request->a12x16, "a12x17"=>$request->a12x17, "a12x18"=>$request->a12x18, "a12x19"=>$request->a12x19, "a12x20"=>$request->a12x20, "a12x21"=>$request->a12x21, "a12x22"=>$request->a12x22, "a12x23"=>$request->a12x23, "a12x24"=>$request->a12x24,
                "a13x1"=>$request->a13x1, "a13x2"=>$request->a13x2, "a13x3"=>$request->a13x3, "a13x4"=>$request->a13x4, "a13x5"=>$request->a13x5, "a13x6"=>$request->a13x6, "a13x7"=>$request->a13x7, "a13x8"=>$request->a13x8, "a13x9"=>$request->a13x9, "a13x10"=>$request->a13x10, "a13x11"=>$request->a13x11, "a13x12"=>$request->a13x12, "a13x13"=>$request->a13x13, "a13x14"=>$request->a13x14, "a13x15"=>$request->a13x15, "a13x16"=>$request->a13x16, "a13x17"=>$request->a13x17, "a13x18"=>$request->a13x18, "a13x19"=>$request->a13x19, "a13x20"=>$request->a13x20, "a13x21"=>$request->a13x21, "a13x22"=>$request->a13x22, "a13x23"=>$request->a13x23, "a13x24"=>$request->a13x24,
                "a14x1"=>$request->a14x1, "a14x2"=>$request->a14x2, "a14x3"=>$request->a14x3, "a14x4"=>$request->a14x4, "a14x5"=>$request->a14x5, "a14x6"=>$request->a14x6, "a14x7"=>$request->a14x7, "a14x8"=>$request->a14x8, "a14x9"=>$request->a14x9, "a14x10"=>$request->a14x10, "a14x11"=>$request->a14x11, "a14x12"=>$request->a14x12, "a14x13"=>$request->a14x13, "a14x14"=>$request->a14x14, "a14x15"=>$request->a14x15, "a14x16"=>$request->a14x16, "a14x17"=>$request->a14x17, "a14x18"=>$request->a14x18, "a14x19"=>$request->a14x19, "a14x20"=>$request->a14x20, "a14x21"=>$request->a14x21, "a14x22"=>$request->a14x22, "a14x23"=>$request->a14x23, "a14x24"=>$request->a14x24,
                "a15x1"=>$request->a15x1, "a15x2"=>$request->a15x2, "a15x3"=>$request->a15x3, "a15x4"=>$request->a15x4, "a15x5"=>$request->a15x5, "a15x6"=>$request->a15x6, "a15x7"=>$request->a15x7, "a15x8"=>$request->a15x8, "a15x9"=>$request->a15x9, "a15x10"=>$request->a15x10, "a15x11"=>$request->a15x11, "a15x12"=>$request->a15x12, "a15x13"=>$request->a15x13, "a15x14"=>$request->a15x14, "a15x15"=>$request->a15x15, "a15x16"=>$request->a15x16, "a15x17"=>$request->a15x17, "a15x18"=>$request->a15x18, "a15x19"=>$request->a15x19, "a15x20"=>$request->a15x20, "a15x21"=>$request->a15x21, "a15x22"=>$request->a15x22, "a15x23"=>$request->a15x23, "a15x24"=>$request->a15x24,
                "a16x1"=>$request->a16x1, "a16x2"=>$request->a16x2, "a16x3"=>$request->a16x3, "a16x4"=>$request->a16x4, "a16x5"=>$request->a16x5, "a16x6"=>$request->a16x6, "a16x7"=>$request->a16x7, "a16x8"=>$request->a16x8, "a16x9"=>$request->a16x9, "a16x10"=>$request->a16x10, "a16x11"=>$request->a16x11, "a16x12"=>$request->a16x12, "a16x13"=>$request->a16x13, "a16x14"=>$request->a16x14, "a16x15"=>$request->a16x15, "a16x16"=>$request->a16x16, "a16x17"=>$request->a16x17, "a16x18"=>$request->a16x18, "a16x19"=>$request->a16x19, "a16x20"=>$request->a16x20, "a16x21"=>$request->a16x21, "a16x22"=>$request->a16x22, "a16x23"=>$request->a16x23, "a16x24"=>$request->a16x24,
                "a17x1"=>$request->a17x1, "a17x2"=>$request->a17x2, "a17x3"=>$request->a17x3, "a17x4"=>$request->a17x4, "a17x5"=>$request->a17x5, "a17x6"=>$request->a17x6, "a17x7"=>$request->a17x7, "a17x8"=>$request->a17x8, "a17x9"=>$request->a17x9, "a17x10"=>$request->a17x10, "a17x11"=>$request->a17x11, "a17x12"=>$request->a17x12, "a17x13"=>$request->a17x13, "a17x14"=>$request->a17x14, "a17x15"=>$request->a17x15, "a17x16"=>$request->a17x16, "a17x17"=>$request->a17x17, "a17x18"=>$request->a17x18, "a17x19"=>$request->a17x19, "a17x20"=>$request->a17x20, "a17x21"=>$request->a17x21, "a17x22"=>$request->a17x22, "a17x23"=>$request->a17x23, "a17x24"=>$request->a17x24,
                "a18x1"=>$request->a18x1, "a18x2"=>$request->a18x2, "a18x3"=>$request->a18x3, "a18x4"=>$request->a18x4, "a18x5"=>$request->a18x5, "a18x6"=>$request->a18x6, "a18x7"=>$request->a18x7, "a18x8"=>$request->a18x8, "a18x9"=>$request->a18x9, "a18x10"=>$request->a18x10, "a18x11"=>$request->a18x11, "a18x12"=>$request->a18x12, "a18x13"=>$request->a18x13, "a18x14"=>$request->a18x14, "a18x15"=>$request->a18x15, "a18x16"=>$request->a18x16, "a18x17"=>$request->a18x17, "a18x18"=>$request->a18x18, "a18x19"=>$request->a18x19, "a18x20"=>$request->a18x20, "a18x21"=>$request->a18x21, "a18x22"=>$request->a18x22, "a18x23"=>$request->a18x23, "a18x24"=>$request->a18x24,
                "a19x1"=>$request->a19x1, "a19x2"=>$request->a19x2, "a19x3"=>$request->a19x3, "a19x4"=>$request->a19x4, "a19x5"=>$request->a19x5, "a19x6"=>$request->a19x6, "a19x7"=>$request->a19x7, "a19x8"=>$request->a19x8, "a19x9"=>$request->a19x9, "a19x10"=>$request->a19x10, "a19x11"=>$request->a19x11, "a19x12"=>$request->a19x12, "a19x13"=>$request->a19x13, "a19x14"=>$request->a19x14, "a19x15"=>$request->a19x15, "a19x16"=>$request->a19x16, "a19x17"=>$request->a19x17, "a19x18"=>$request->a19x18, "a19x19"=>$request->a19x19, "a19x20"=>$request->a19x20, "a19x21"=>$request->a19x21, "a19x22"=>$request->a19x22, "a19x23"=>$request->a19x23, "a19x24"=>$request->a19x24,
                "a20x1"=>$request->a20x1, "a20x2"=>$request->a20x2, "a20x3"=>$request->a20x3, "a20x4"=>$request->a20x4, "a20x5"=>$request->a20x5, "a20x6"=>$request->a20x6, "a20x7"=>$request->a20x7, "a20x8"=>$request->a20x8, "a20x9"=>$request->a20x9, "a20x10"=>$request->a20x10, "a20x11"=>$request->a20x11, "a20x12"=>$request->a20x12, "a20x13"=>$request->a20x13, "a20x14"=>$request->a20x14, "a20x15"=>$request->a20x15, "a20x16"=>$request->a20x16, "a20x17"=>$request->a20x17, "a20x18"=>$request->a20x18, "a20x19"=>$request->a20x19, "a20x20"=>$request->a20x20, "a20x21"=>$request->a20x21, "a20x22"=>$request->a20x22, "a20x23"=>$request->a20x23, "a20x24"=>$request->a20x24,
                "a21x1"=>$request->a21x1, "a21x2"=>$request->a21x2, "a21x3"=>$request->a21x3, "a21x4"=>$request->a21x4, "a21x5"=>$request->a21x5, "a21x6"=>$request->a21x6, "a21x7"=>$request->a21x7, "a21x8"=>$request->a21x8, "a21x9"=>$request->a21x9, "a21x10"=>$request->a21x10, "a21x11"=>$request->a21x11, "a21x12"=>$request->a21x12, "a21x13"=>$request->a21x13, "a21x14"=>$request->a21x14, "a21x15"=>$request->a21x15, "a21x16"=>$request->a21x16, "a21x17"=>$request->a21x17, "a21x18"=>$request->a21x18, "a21x19"=>$request->a21x19, "a21x20"=>$request->a21x20, "a21x21"=>$request->a21x21, "a21x22"=>$request->a21x22, "a21x23"=>$request->a21x23, "a21x24"=>$request->a21x24,
                "a22x1"=>$request->a22x1, "a22x2"=>$request->a22x2, "a22x3"=>$request->a22x3, "a22x4"=>$request->a22x4, "a22x5"=>$request->a22x5, "a22x6"=>$request->a22x6, "a22x7"=>$request->a22x7, "a22x8"=>$request->a22x8, "a22x9"=>$request->a22x9, "a22x10"=>$request->a22x10, "a22x11"=>$request->a22x11, "a22x12"=>$request->a22x12, "a22x13"=>$request->a22x13, "a22x14"=>$request->a22x14, "a22x15"=>$request->a22x15, "a22x16"=>$request->a22x16, "a22x17"=>$request->a22x17, "a22x18"=>$request->a22x18, "a22x19"=>$request->a22x19, "a22x20"=>$request->a22x20, "a22x21"=>$request->a22x21, "a22x22"=>$request->a22x22, "a22x23"=>$request->a22x23, "a22x24"=>$request->a22x24,
                "a23x1"=>$request->a23x1, "a23x2"=>$request->a23x2, "a23x3"=>$request->a23x3, "a23x4"=>$request->a23x4, "a23x5"=>$request->a23x5, "a23x6"=>$request->a23x6, "a23x7"=>$request->a23x7, "a23x8"=>$request->a23x8, "a23x9"=>$request->a23x9, "a23x10"=>$request->a23x10, "a23x11"=>$request->a23x11, "a23x12"=>$request->a23x12, "a23x13"=>$request->a23x13, "a23x14"=>$request->a23x14, "a23x15"=>$request->a23x15, "a23x16"=>$request->a23x16, "a23x17"=>$request->a23x17, "a23x18"=>$request->a23x18, "a23x19"=>$request->a23x19, "a23x20"=>$request->a23x20, "a23x21"=>$request->a23x21, "a23x22"=>$request->a23x22, "a23x23"=>$request->a23x23, "a23x24"=>$request->a23x24,
                "a24x1"=>$request->a24x1, "a24x2"=>$request->a24x2, "a24x3"=>$request->a24x3, "a24x4"=>$request->a24x4, "a24x5"=>$request->a24x5, "a24x6"=>$request->a24x6, "a24x7"=>$request->a24x7, "a24x8"=>$request->a24x8, "a24x9"=>$request->a24x9, "a24x10"=>$request->a24x10, "a24x11"=>$request->a24x11, "a24x12"=>$request->a24x12, "a24x13"=>$request->a24x13, "a24x14"=>$request->a24x14, "a24x15"=>$request->a24x15, "a24x16"=>$request->a24x16, "a24x17"=>$request->a24x17, "a24x18"=>$request->a24x18, "a24x19"=>$request->a24x19, "a24x20"=>$request->a24x20, "a24x21"=>$request->a24x21, "a24x22"=>$request->a24x22, "a24x23"=>$request->a24x23, "a24x24"=>$request->a24x24,
                "a25x1"=>$request->a25x1, "a25x2"=>$request->a25x2, "a25x3"=>$request->a25x3, "a25x4"=>$request->a25x4, "a25x5"=>$request->a25x5, "a25x6"=>$request->a25x6, "a25x7"=>$request->a25x7, "a25x8"=>$request->a25x8, "a25x9"=>$request->a25x9, "a25x10"=>$request->a25x10, "a25x11"=>$request->a25x11, "a25x12"=>$request->a25x12, "a25x13"=>$request->a25x13, "a25x14"=>$request->a25x14, "a25x15"=>$request->a25x15, "a25x16"=>$request->a25x16, "a25x17"=>$request->a25x17, "a25x18"=>$request->a25x18, "a25x19"=>$request->a25x19, "a25x20"=>$request->a25x20, "a25x21"=>$request->a25x21, "a25x22"=>$request->a25x22, "a25x23"=>$request->a25x23, "a25x24"=>$request->a25x24,
                "a26x1"=>$request->a26x1, "a26x2"=>$request->a26x2, "a26x3"=>$request->a26x3, "a26x4"=>$request->a26x4, "a26x5"=>$request->a26x5, "a26x6"=>$request->a26x6, "a26x7"=>$request->a26x7, "a26x8"=>$request->a26x8, "a26x9"=>$request->a26x9, "a26x10"=>$request->a26x10, "a26x11"=>$request->a26x11, "a26x12"=>$request->a26x12, "a26x13"=>$request->a26x13, "a26x14"=>$request->a26x14, "a26x15"=>$request->a26x15, "a26x16"=>$request->a26x16, "a26x17"=>$request->a26x17, "a26x18"=>$request->a26x18, "a26x19"=>$request->a26x19, "a26x20"=>$request->a26x20, "a26x21"=>$request->a26x21, "a26x22"=>$request->a26x22, "a26x23"=>$request->a26x23, "a26x24"=>$request->a26x24,
                "a27x1"=>$request->a27x1, "a27x2"=>$request->a27x2, "a27x3"=>$request->a27x3, "a27x4"=>$request->a27x4, "a27x5"=>$request->a27x5, "a27x6"=>$request->a27x6, "a27x7"=>$request->a27x7, "a27x8"=>$request->a27x8, "a27x9"=>$request->a27x9, "a27x10"=>$request->a27x10, "a27x11"=>$request->a27x11, "a27x12"=>$request->a27x12, "a27x13"=>$request->a27x13, "a27x14"=>$request->a27x14, "a27x15"=>$request->a27x15, "a27x16"=>$request->a27x16, "a27x17"=>$request->a27x17, "a27x18"=>$request->a27x18, "a27x19"=>$request->a27x19, "a27x20"=>$request->a27x20, "a27x21"=>$request->a27x21, "a27x22"=>$request->a27x22, "a27x23"=>$request->a27x23, "a27x24"=>$request->a27x24,
                "a28x1"=>$request->a28x1, "a28x2"=>$request->a28x2, "a28x3"=>$request->a28x3, "a28x4"=>$request->a28x4, "a28x5"=>$request->a28x5, "a28x6"=>$request->a28x6, "a28x7"=>$request->a28x7, "a28x8"=>$request->a28x8, "a28x9"=>$request->a28x9, "a28x10"=>$request->a28x10, "a28x11"=>$request->a28x11, "a28x12"=>$request->a28x12, "a28x13"=>$request->a28x13, "a28x14"=>$request->a28x14, "a28x15"=>$request->a28x15, "a28x16"=>$request->a28x16, "a28x17"=>$request->a28x17, "a28x18"=>$request->a28x18, "a28x19"=>$request->a28x19, "a28x20"=>$request->a28x20, "a28x21"=>$request->a28x21, "a28x22"=>$request->a28x22, "a28x23"=>$request->a28x23, "a28x24"=>$request->a28x24,
                "a29x1"=>$request->a29x1, "a29x2"=>$request->a29x2, "a29x3"=>$request->a29x3, "a29x4"=>$request->a29x4, "a29x5"=>$request->a29x5, "a29x6"=>$request->a29x6, "a29x7"=>$request->a29x7, "a29x8"=>$request->a29x8, "a29x9"=>$request->a29x9, "a29x10"=>$request->a29x10, "a29x11"=>$request->a29x11, "a29x12"=>$request->a29x12, "a29x13"=>$request->a29x13, "a29x14"=>$request->a29x14, "a29x15"=>$request->a29x15, "a29x16"=>$request->a29x16, "a29x17"=>$request->a29x17, "a29x18"=>$request->a29x18, "a29x19"=>$request->a29x19, "a29x20"=>$request->a29x20, "a29x21"=>$request->a29x21, "a29x22"=>$request->a29x22, "a29x23"=>$request->a29x23, "a29x24"=>$request->a29x24,
                "a30x1"=>$request->a30x1, "a30x2"=>$request->a30x2, "a30x3"=>$request->a30x3, "a30x4"=>$request->a30x4, "a30x5"=>$request->a30x5, "a30x6"=>$request->a30x6, "a30x7"=>$request->a30x7, "a30x8"=>$request->a30x8, "a30x9"=>$request->a30x9, "a30x10"=>$request->a30x10, "a30x11"=>$request->a30x11, "a30x12"=>$request->a30x12, "a30x13"=>$request->a30x13, "a30x14"=>$request->a30x14, "a30x15"=>$request->a30x15, "a30x16"=>$request->a30x16, "a30x17"=>$request->a30x17, "a30x18"=>$request->a30x18, "a30x19"=>$request->a30x19, "a30x20"=>$request->a30x20, "a30x21"=>$request->a30x21, "a30x22"=>$request->a30x22, "a30x23"=>$request->a30x23, "a30x24"=>$request->a30x24,
            ]);
        }
        return redirect('/admin/organoleptik/'.$id_ppk.'/'.$jenis)->with('berhasilSimpan','Data berhasil disimpan');
    }

    public function reset(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);
        $ada = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis', $jenis)
            ->select('*')
            ->get();

        if(count($ada) > 0){
            organoleptik::where('id_ppk', $id_ppk)->where('jenis', $jenis)->delete();
        }
        return redirect('/admin/organoleptik/'.$id_ppk.'/'.$jenis)->with('berhasilSimpan','Data berhasil direset');
    }

    public function print(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);
        // $ada = DB::connection('sqlsrv2')->table('organoleptik')
        //     ->where('id_ppk',$id_ppk)
        //     ->where('jenis', $jenis)
        //     ->select('*')
        //     ->get();

        // if(count($ada) > 0){
        //     organoleptik::where('id_ppk', $id_ppk)->where('jenis', $jenis)->delete();
        // }
        $list = DB::connection('sqlsrv2')->table('v_data_header')
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();

        $header = DB::connection('sqlsrv2')->table('v_data_header')
            ->where('id_ppk',$id_ppk)
            ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
            ->get();



        $check = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->orderBy('id_ppk','desc')
            ->select('*')
            ->get();

        $check1 = DB::connection('sqlsrv2')->table('organoleptik1')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->orderBy('id_ppk','desc')
            ->select('*')
            ->get();

        $check2 = DB::connection('sqlsrv2')->table('organoleptik2')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->orderBy('id_ppk','desc')
            ->select('*')
            ->get();


        return view('admin.organoleptikprint',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            'jenis'=>$jenis,
            'id_ppk'=>$id_ppk,
            'check1'=>$check1,
            'check2'=>$check2,
            
        ]);
    }

    public function edit(Request $request){

        $jenis = request()->segment(4);

        $parameter = DB::connection('sqlsrv2')->table('parameter')
            ->where('jenis',$jenis)
            ->select('*')
            ->get();


        return view('admin.organoleptikedit',[
            'title'=>'Organoleptik',
            'jenis'=>$jenis,
            'parameter'=>$parameter
            
        ]);
    }

    public function editSubmit(Request $request){

        $jenis = request()->segment(4);

        $ada = DB::connection('sqlsrv2')->table('parameter')
            ->where('jenis',$jenis)
            ->select('*')
            ->get();

        if(count($ada) > 0){
            parameter::where('jenis', $jenis)->update([
                "jenis"=>$jenis,
                "parameter1"=>$request->parameter1, "parameter2"=>$request->parameter2, "parameter3"=>$request->parameter3, "parameter4"=>$request->parameter4, "parameter5"=>$request->parameter5, "parameter6"=>$request->parameter6, "parameter7"=>$request->parameter7, "parameter8"=>$request->parameter8, "parameter9"=>$request->parameter9, "parameter10"=>$request->parameter10,
                "parameter11"=>$request->parameter11, "parameter12"=>$request->parameter12, "parameter13"=>$request->parameter13, "parameter14"=>$request->parameter14, "parameter15"=>$request->parameter15, "parameter16"=>$request->parameter16, "parameter17"=>$request->parameter17, "parameter18"=>$request->parameter18, "parameter19"=>$request->parameter19, "parameter20"=>$request->parameter20,
                "parameter21"=>$request->parameter21, "parameter22"=>$request->parameter22, "parameter23"=>$request->parameter23, "parameter24"=>$request->parameter24, "parameter25"=>$request->parameter25, "parameter26"=>$request->parameter26, "parameter27"=>$request->parameter27, "parameter28"=>$request->parameter28, "parameter29"=>$request->parameter29, "parameter30"=>$request->parameter30,
                "parameter31"=>$request->parameter31, "parameter32"=>$request->parameter32, "parameter33"=>$request->parameter33, "parameter34"=>$request->parameter34, "parameter35"=>$request->parameter35, "parameter36"=>$request->parameter36, "parameter37"=>$request->parameter37, "parameter38"=>$request->parameter38, "parameter39"=>$request->parameter39, "parameter40"=>$request->parameter40,
                "parameter41"=>$request->parameter41, "parameter42"=>$request->parameter42, "parameter43"=>$request->parameter43, "parameter44"=>$request->parameter44, "parameter45"=>$request->parameter45, "parameter46"=>$request->parameter46, "parameter47"=>$request->parameter47, "parameter48"=>$request->parameter48, "parameter49"=>$request->parameter49, "parameter50"=>$request->parameter50,
                "nilai1"=>$request->nilai1, "nilai2"=>$request->nilai2, "nilai3"=>$request->nilai3, "nilai4"=>$request->nilai4, "nilai5"=>$request->nilai5, "nilai6"=>$request->nilai6, "nilai7"=>$request->nilai7, "nilai8"=>$request->nilai8, "nilai9"=>$request->nilai9, "nilai10"=>$request->nilai10,
                "nilai11"=>$request->nilai11, "nilai12"=>$request->nilai12, "nilai13"=>$request->nilai13, "nilai14"=>$request->nilai14, "nilai15"=>$request->nilai15, "nilai16"=>$request->nilai16, "nilai17"=>$request->nilai17, "nilai18"=>$request->nilai18, "nilai19"=>$request->nilai19, "nilai20"=>$request->nilai20,
                "nilai21"=>$request->nilai21, "nilai22"=>$request->nilai22, "nilai23"=>$request->nilai23, "nilai24"=>$request->nilai24, "nilai25"=>$request->nilai25, "nilai26"=>$request->nilai26, "nilai27"=>$request->nilai27, "nilai28"=>$request->nilai28, "nilai29"=>$request->nilai29, "nilai30"=>$request->nilai30,
                "nilai31"=>$request->nilai31, "nilai32"=>$request->nilai32, "nilai33"=>$request->nilai33, "nilai34"=>$request->nilai34, "nilai35"=>$request->nilai35, "nilai36"=>$request->nilai36, "nilai37"=>$request->nilai37, "nilai38"=>$request->nilai38, "nilai39"=>$request->nilai39, "nilai40"=>$request->nilai40,
                "nilai41"=>$request->nilai41, "nilai42"=>$request->nilai42, "nilai43"=>$request->nilai43, "nilai44"=>$request->nilai44, "nilai45"=>$request->nilai45, "nilai46"=>$request->nilai46, "nilai47"=>$request->nilai47, "nilai48"=>$request->nilai48, "nilai49"=>$request->nilai49, "nilai50"=>$request->nilai50,
                 ]);
        }
        else{
            parameter::insert([
                "jenis"=>$jenis,
                "parameter1"=>$request->parameter1, "parameter2"=>$request->parameter2, "parameter3"=>$request->parameter3, "parameter4"=>$request->parameter4, "parameter5"=>$request->parameter5, "parameter6"=>$request->parameter6, "parameter7"=>$request->parameter7, "parameter8"=>$request->parameter8, "parameter9"=>$request->parameter9, "parameter10"=>$request->parameter10,
                "parameter11"=>$request->parameter11, "parameter12"=>$request->parameter12, "parameter13"=>$request->parameter13, "parameter14"=>$request->parameter14, "parameter15"=>$request->parameter15, "parameter16"=>$request->parameter16, "parameter17"=>$request->parameter17, "parameter18"=>$request->parameter18, "parameter19"=>$request->parameter19, "parameter20"=>$request->parameter20,
                "parameter21"=>$request->parameter21, "parameter22"=>$request->parameter22, "parameter23"=>$request->parameter23, "parameter24"=>$request->parameter24, "parameter25"=>$request->parameter25, "parameter26"=>$request->parameter26, "parameter27"=>$request->parameter27, "parameter28"=>$request->parameter28, "parameter29"=>$request->parameter29, "parameter30"=>$request->parameter30,
                "parameter31"=>$request->parameter31, "parameter32"=>$request->parameter32, "parameter33"=>$request->parameter33, "parameter34"=>$request->parameter34, "parameter35"=>$request->parameter35, "parameter36"=>$request->parameter36, "parameter37"=>$request->parameter37, "parameter38"=>$request->parameter38, "parameter39"=>$request->parameter39, "parameter40"=>$request->parameter40,
                "parameter41"=>$request->parameter41, "parameter42"=>$request->parameter42, "parameter43"=>$request->parameter43, "parameter44"=>$request->parameter44, "parameter45"=>$request->parameter45, "parameter46"=>$request->parameter46, "parameter47"=>$request->parameter47, "parameter48"=>$request->parameter48, "parameter49"=>$request->parameter49, "parameter50"=>$request->parameter50,
                "nilai1"=>$request->nilai1, "nilai2"=>$request->nilai2, "nilai3"=>$request->nilai3, "nilai4"=>$request->nilai4, "nilai5"=>$request->nilai5, "nilai6"=>$request->nilai6, "nilai7"=>$request->nilai7, "nilai8"=>$request->nilai8, "nilai9"=>$request->nilai9, "nilai10"=>$request->nilai10,
                "nilai11"=>$request->nilai11, "nilai12"=>$request->nilai12, "nilai13"=>$request->nilai13, "nilai14"=>$request->nilai14, "nilai15"=>$request->nilai15, "nilai16"=>$request->nilai16, "nilai17"=>$request->nilai17, "nilai18"=>$request->nilai18, "nilai19"=>$request->nilai19, "nilai20"=>$request->nilai20,
                "nilai21"=>$request->nilai21, "nilai22"=>$request->nilai22, "nilai23"=>$request->nilai23, "nilai24"=>$request->nilai24, "nilai25"=>$request->nilai25, "nilai26"=>$request->nilai26, "nilai27"=>$request->nilai27, "nilai28"=>$request->nilai28, "nilai29"=>$request->nilai29, "nilai30"=>$request->nilai30,
                "nilai31"=>$request->nilai31, "nilai32"=>$request->nilai32, "nilai33"=>$request->nilai33, "nilai34"=>$request->nilai34, "nilai35"=>$request->nilai35, "nilai36"=>$request->nilai36, "nilai37"=>$request->nilai37, "nilai38"=>$request->nilai38, "nilai39"=>$request->nilai39, "nilai40"=>$request->nilai40,
                "nilai41"=>$request->nilai41, "nilai42"=>$request->nilai42, "nilai43"=>$request->nilai43, "nilai44"=>$request->nilai44, "nilai45"=>$request->nilai45, "nilai46"=>$request->nilai46, "nilai47"=>$request->nilai47, "nilai48"=>$request->nilai48, "nilai49"=>$request->nilai49, "nilai50"=>$request->nilai50,
            ]);
        }
        return redirect('/admin/organoleptik')->with('berhasilSimpan','Data berhasil disimpan');
    }


}
