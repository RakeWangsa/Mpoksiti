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
                "A91"=>$request->A91, "A92"=>$request->A92, "A93"=>$request->A93, "A94"=>$request->A94, "A95"=>$request->A95, "A96"=>$request->A96, "A97"=>$request->A97, "A98"=>$request->A98, "A99"=>$request->A99, "A910"=>$request->A910, "A911"=>$request->A911, "A912"=>$request->A912, "A913"=>$request->A913, "A914"=>$request->A914, "A915"=>$request->A915, "A916"=>$request->A916, "A917"=>$request->A917, "A918"=>$request->A918, "A919"=>$request->A919, "A920"=>$request->A920, "A921"=>$request->A921, "A922"=>$request->A922, "A923"=>$request->A923, "A924"=>$request->A924,
                "A81"=>$request->A81, "A82"=>$request->A82, "A83"=>$request->A83, "A84"=>$request->A84, "A85"=>$request->A85, "A86"=>$request->A86, "A87"=>$request->A87, "A88"=>$request->A88, "A89"=>$request->A89, "A810"=>$request->A810, "A811"=>$request->A811, "A812"=>$request->A812, "A813"=>$request->A813, "A814"=>$request->A814, "A815"=>$request->A815, "A816"=>$request->A816, "A817"=>$request->A817, "A818"=>$request->A818, "A819"=>$request->A819, "A820"=>$request->A820, "A821"=>$request->A821, "A822"=>$request->A822, "A823"=>$request->A823, "A824"=>$request->A824,
                "A71"=>$request->A71, "A72"=>$request->A72, "A73"=>$request->A73, "A74"=>$request->A74, "A75"=>$request->A75, "A76"=>$request->A76, "A77"=>$request->A77, "A78"=>$request->A78, "A79"=>$request->A79, "A710"=>$request->A710, "A711"=>$request->A711, "A712"=>$request->A712, "A713"=>$request->A713, "A714"=>$request->A714, "A715"=>$request->A715, "A716"=>$request->A716, "A717"=>$request->A717, "A718"=>$request->A718, "A719"=>$request->A719, "A720"=>$request->A720, "A721"=>$request->A721, "A722"=>$request->A722, "A723"=>$request->A723, "A724"=>$request->A724,
                "A61"=>$request->A61, "A62"=>$request->A62, "A63"=>$request->A63, "A64"=>$request->A64, "A65"=>$request->A65, "A66"=>$request->A66, "A67"=>$request->A67, "A68"=>$request->A68, "A69"=>$request->A69, "A610"=>$request->A610, "A611"=>$request->A611, "A612"=>$request->A612, "A613"=>$request->A613, "A614"=>$request->A614, "A615"=>$request->A615, "A616"=>$request->A616, "A617"=>$request->A617, "A618"=>$request->A618, "A619"=>$request->A619, "A620"=>$request->A620, "A621"=>$request->A621, "A622"=>$request->A622, "A623"=>$request->A623, "A624"=>$request->A624,
                "A51"=>$request->A51, "A52"=>$request->A52, "A53"=>$request->A53, "A54"=>$request->A54, "A55"=>$request->A55, "A56"=>$request->A56, "A57"=>$request->A57, "A58"=>$request->A58, "A59"=>$request->A59, "A510"=>$request->A510, "A511"=>$request->A511, "A512"=>$request->A512, "A513"=>$request->A513, "A514"=>$request->A514, "A515"=>$request->A515, "A516"=>$request->A516, "A517"=>$request->A517, "A518"=>$request->A518, "A519"=>$request->A519, "A520"=>$request->A520, "A521"=>$request->A521, "A522"=>$request->A522, "A523"=>$request->A523, "A524"=>$request->A524,
                "A31"=>$request->A31, "A32"=>$request->A32, "A33"=>$request->A33, "A34"=>$request->A34, "A35"=>$request->A35, "A36"=>$request->A36, "A37"=>$request->A37, "A38"=>$request->A38, "A39"=>$request->A39, "A310"=>$request->A310, "A311"=>$request->A311, "A312"=>$request->A312, "A313"=>$request->A313, "A314"=>$request->A314, "A315"=>$request->A315, "A316"=>$request->A316, "A317"=>$request->A317, "A318"=>$request->A318, "A319"=>$request->A319, "A320"=>$request->A320, "A321"=>$request->A321, "A322"=>$request->A322, "A323"=>$request->A323, "A324"=>$request->A324,
                "A11"=>$request->A11, "A12"=>$request->A12, "A13"=>$request->A13, "A14"=>$request->A14, "A15"=>$request->A15, "A16"=>$request->A16, "A17"=>$request->A17, "A18"=>$request->A18, "A19"=>$request->A19, "A110"=>$request->A110, "A111"=>$request->A111, "A112"=>$request->A112, "A113"=>$request->A113, "A114"=>$request->A114, "A115"=>$request->A115, "A116"=>$request->A116, "A117"=>$request->A117, "A118"=>$request->A118, "A119"=>$request->A119, "A120"=>$request->A120, "A121"=>$request->A121, "A122"=>$request->A122, "A123"=>$request->A123, "A124"=>$request->A124,
                "B91"=>$request->B91, "B92"=>$request->B92, "B93"=>$request->B93, "B94"=>$request->B94, "B95"=>$request->B95, "B96"=>$request->B96, "B97"=>$request->B97, "B98"=>$request->B98, "B99"=>$request->B99, "B910"=>$request->B910, "B911"=>$request->B911, "B912"=>$request->B912, "B913"=>$request->B913, "B914"=>$request->B914, "B915"=>$request->B915, "B916"=>$request->B916, "B917"=>$request->B917, "B918"=>$request->B918, "B919"=>$request->B919, "B920"=>$request->B920, "B921"=>$request->B921, "B922"=>$request->B922, "B923"=>$request->B923, "B924"=>$request->B924,
                "B81"=>$request->B81, "B82"=>$request->B82, "B83"=>$request->B83, "B84"=>$request->B84, "B85"=>$request->B85, "B86"=>$request->B86, "B87"=>$request->B87, "B88"=>$request->B88, "B89"=>$request->B89, "B810"=>$request->B810, "B811"=>$request->B811, "B812"=>$request->B812, "B813"=>$request->B813, "B814"=>$request->B814, "B815"=>$request->B815, "B816"=>$request->B816, "B817"=>$request->B817, "B818"=>$request->B818, "B819"=>$request->B819, "B820"=>$request->B820, "B821"=>$request->B821, "B822"=>$request->B822, "B823"=>$request->B823, "B824"=>$request->B824,
                "B71"=>$request->B71, "B72"=>$request->B72, "B73"=>$request->B73, "B74"=>$request->B74, "B75"=>$request->B75, "B76"=>$request->B76, "B77"=>$request->B77, "B78"=>$request->B78, "B79"=>$request->B79, "B710"=>$request->B710, "B711"=>$request->B711, "B712"=>$request->B712, "B713"=>$request->B713, "B714"=>$request->B714, "B715"=>$request->B715, "B716"=>$request->B716, "B717"=>$request->B717, "B718"=>$request->B718, "B719"=>$request->B719, "B720"=>$request->B720, "B721"=>$request->B721, "B722"=>$request->B722, "B723"=>$request->B723, "B724"=>$request->B724,
                "B61"=>$request->B61, "B62"=>$request->B62, "B63"=>$request->B63, "B64"=>$request->B64, "B65"=>$request->B65, "B66"=>$request->B66, "B67"=>$request->B67, "B68"=>$request->B68, "B69"=>$request->B69, "B610"=>$request->B610, "B611"=>$request->B611, "B612"=>$request->B612, "B613"=>$request->B613, "B614"=>$request->B614, "B615"=>$request->B615, "B616"=>$request->B616, "B617"=>$request->B617, "B618"=>$request->B618, "B619"=>$request->B619, "B620"=>$request->B620, "B621"=>$request->B621, "B622"=>$request->B622, "B623"=>$request->B623, "B624"=>$request->B624,
                "B51"=>$request->B51, "B52"=>$request->B52, "B53"=>$request->B53, "B54"=>$request->B54, "B55"=>$request->B55, "B56"=>$request->B56, "B57"=>$request->B57, "B58"=>$request->B58, "B59"=>$request->B59, "B510"=>$request->B510, "B511"=>$request->B511, "B512"=>$request->B512, "B513"=>$request->B513, "B514"=>$request->B514, "B515"=>$request->B515, "B516"=>$request->B516, "B517"=>$request->B517, "B518"=>$request->B518, "B519"=>$request->B519, "B520"=>$request->B520, "B521"=>$request->B521, "B522"=>$request->B522, "B523"=>$request->B523, "B524"=>$request->B524,
                "B31"=>$request->B31, "B32"=>$request->B32, "B33"=>$request->B33, "B34"=>$request->B34, "B35"=>$request->B35, "B36"=>$request->B36, "B37"=>$request->B37, "B38"=>$request->B38, "B39"=>$request->B39, "B310"=>$request->B310, "B311"=>$request->B311, "B312"=>$request->B312, "B313"=>$request->B313, "B314"=>$request->B314, "B315"=>$request->B315, "B316"=>$request->B316, "B317"=>$request->B317, "B318"=>$request->B318, "B319"=>$request->B319, "B320"=>$request->B320, "B321"=>$request->B321, "B322"=>$request->B322, "B323"=>$request->B323, "B324"=>$request->B324,
                "B11"=>$request->B11, "B12"=>$request->B12, "B13"=>$request->B13, "B14"=>$request->B14, "B15"=>$request->B15, "B16"=>$request->B16, "B17"=>$request->B17, "B18"=>$request->B18, "B19"=>$request->B19, "B110"=>$request->B110, "B111"=>$request->B111, "B112"=>$request->B112, "B113"=>$request->B113, "B114"=>$request->B114, "B115"=>$request->B115, "B116"=>$request->B116, "B117"=>$request->B117, "B118"=>$request->B118, "B119"=>$request->B119, "B120"=>$request->B120, "B121"=>$request->B121, "B122"=>$request->B122, "B123"=>$request->B123, "B124"=>$request->B124, 
                "C91"=>$request->C91, "C92"=>$request->C92, "C93"=>$request->C93, "C94"=>$request->C94, "C95"=>$request->C95, "C96"=>$request->C96, "C97"=>$request->C97, "C98"=>$request->C98, "C99"=>$request->C99, "C910"=>$request->C910, "C911"=>$request->C911, "C912"=>$request->C912, "C913"=>$request->C913, "C914"=>$request->C914, "C915"=>$request->C915, "C916"=>$request->C916, "C917"=>$request->C917, "C918"=>$request->C918, "C919"=>$request->C919, "C920"=>$request->C920, "C921"=>$request->C921, "C922"=>$request->C922, "C923"=>$request->C923, "C924"=>$request->C924,
                "C81"=>$request->C81, "C82"=>$request->C82, "C83"=>$request->C83, "C84"=>$request->C84, "C85"=>$request->C85, "C86"=>$request->C86, "C87"=>$request->C87, "C88"=>$request->C88, "C89"=>$request->C89, "C810"=>$request->C810, "C811"=>$request->C811, "C812"=>$request->C812, "C813"=>$request->C813, "C814"=>$request->C814, "C815"=>$request->C815, "C816"=>$request->C816, "C817"=>$request->C817, "C818"=>$request->C818, "C819"=>$request->C819, "C820"=>$request->C820, "C821"=>$request->C821, "C822"=>$request->C822, "C823"=>$request->C823, "C824"=>$request->C824,
                "C71"=>$request->C71, "C72"=>$request->C72, "C73"=>$request->C73, "C74"=>$request->C74, "C75"=>$request->C75, "C76"=>$request->C76, "C77"=>$request->C77, "C78"=>$request->C78, "C79"=>$request->C79, "C710"=>$request->C710, "C711"=>$request->C711, "C712"=>$request->C712, "C713"=>$request->C713, "C714"=>$request->C714, "C715"=>$request->C715, "C716"=>$request->C716, "C717"=>$request->C717, "C718"=>$request->C718, "C719"=>$request->C719, "C720"=>$request->C720, "C721"=>$request->C721, "C722"=>$request->C722, "C723"=>$request->C723, "C724"=>$request->C724,
                "C61"=>$request->C61, "C62"=>$request->C62, "C63"=>$request->C63, "C64"=>$request->C64, "C65"=>$request->C65, "C66"=>$request->C66, "C67"=>$request->C67, "C68"=>$request->C68, "C69"=>$request->C69, "C610"=>$request->C610, "C611"=>$request->C611, "C612"=>$request->C612, "C613"=>$request->C613, "C614"=>$request->C614, "C615"=>$request->C615, "C616"=>$request->C616, "C617"=>$request->C617, "C618"=>$request->C618, "C619"=>$request->C619, "C620"=>$request->C620, "C621"=>$request->C621, "C622"=>$request->C622, "C623"=>$request->C623, "C624"=>$request->C624,
                "C51"=>$request->C51, "C52"=>$request->C52, "C53"=>$request->C53, "C54"=>$request->C54, "C55"=>$request->C55, "C56"=>$request->C56, "C57"=>$request->C57, "C58"=>$request->C58, "C59"=>$request->C59, "C510"=>$request->C510, "C511"=>$request->C511, "C512"=>$request->C512, "C513"=>$request->C513, "C514"=>$request->C514, "C515"=>$request->C515, "C516"=>$request->C516, "C517"=>$request->C517, "C518"=>$request->C518, "C519"=>$request->C519, "C520"=>$request->C520, "C521"=>$request->C521, "C522"=>$request->C522, "C523"=>$request->C523, "C524"=>$request->C524,
                "C31"=>$request->C31, "C32"=>$request->C32, "C33"=>$request->C33, "C34"=>$request->C34, "C35"=>$request->C35, "C36"=>$request->C36, "C37"=>$request->C37, "C38"=>$request->C38, "C39"=>$request->C39, "C310"=>$request->C310, "C311"=>$request->C311, "C312"=>$request->C312, "C313"=>$request->C313, "C314"=>$request->C314, "C315"=>$request->C315, "C316"=>$request->C316, "C317"=>$request->C317, "C318"=>$request->C318, "C319"=>$request->C319, "C320"=>$request->C320, "C321"=>$request->C321, "C322"=>$request->C322, "C323"=>$request->C323, "C324"=>$request->C324,
                "C11"=>$request->C11, "C12"=>$request->C12, "C13"=>$request->C13, "C14"=>$request->C14, "C15"=>$request->C15, "C16"=>$request->C16, "C17"=>$request->C17, "C18"=>$request->C18, "C19"=>$request->C19, "C110"=>$request->C110, "C111"=>$request->C111, "C112"=>$request->C112, "C113"=>$request->C113, "C114"=>$request->C114, "C115"=>$request->C115, "C116"=>$request->C116, "C117"=>$request->C117, "C118"=>$request->C118, "C119"=>$request->C119, "C120"=>$request->C120, "C121"=>$request->C121, "C122"=>$request->C122, "C123"=>$request->C123, "C124"=>$request->C124,
                "D91"=>$request->D91, "D92"=>$request->D92, "D93"=>$request->D93, "D94"=>$request->D94, "D95"=>$request->D95, "D96"=>$request->D96, "D97"=>$request->D97, "D98"=>$request->D98, "D99"=>$request->D99, "D910"=>$request->D910, "D911"=>$request->D911, "D912"=>$request->D912, "D913"=>$request->D913, "D914"=>$request->D914, "D915"=>$request->D915, "D916"=>$request->D916, "D917"=>$request->D917, "D918"=>$request->D918, "D919"=>$request->D919, "D920"=>$request->D920, "D921"=>$request->D921, "D922"=>$request->D922, "D923"=>$request->D923, "D924"=>$request->D924,
                "D81"=>$request->D81, "D82"=>$request->D82, "D83"=>$request->D83, "D84"=>$request->D84, "D85"=>$request->D85, "D86"=>$request->D86, "D87"=>$request->D87, "D88"=>$request->D88, "D89"=>$request->D89, "D810"=>$request->D810, "D811"=>$request->D811, "D812"=>$request->D812, "D813"=>$request->D813, "D814"=>$request->D814, "D815"=>$request->D815, "D816"=>$request->D816, "D817"=>$request->D817, "D818"=>$request->D818, "D819"=>$request->D819, "D820"=>$request->D820, "D821"=>$request->D821, "D822"=>$request->D822, "D823"=>$request->D823, "D824"=>$request->D824,
                "D71"=>$request->D71, "D72"=>$request->D72, "D73"=>$request->D73, "D74"=>$request->D74, "D75"=>$request->D75, "D76"=>$request->D76, "D77"=>$request->D77, "D78"=>$request->D78, "D79"=>$request->D79, "D710"=>$request->D710, "D711"=>$request->D711, "D712"=>$request->D712, "D713"=>$request->D713, "D714"=>$request->D714, "D715"=>$request->D715, "D716"=>$request->D716, "D717"=>$request->D717, "D718"=>$request->D718, "D719"=>$request->D719, "D720"=>$request->D720, "D721"=>$request->D721, "D722"=>$request->D722, "D723"=>$request->D723, "D724"=>$request->D724,
                "D61"=>$request->D61, "D62"=>$request->D62, "D63"=>$request->D63, "D64"=>$request->D64, "D65"=>$request->D65, "D66"=>$request->D66, "D67"=>$request->D67, "D68"=>$request->D68, "D69"=>$request->D69, "D610"=>$request->D610, "D611"=>$request->D611, "D612"=>$request->D612, "D613"=>$request->D613, "D614"=>$request->D614, "D615"=>$request->D615, "D616"=>$request->D616, "D617"=>$request->D617, "D618"=>$request->D618, "D619"=>$request->D619, "D620"=>$request->D620, "D621"=>$request->D621, "D622"=>$request->D622, "D623"=>$request->D623, "D624"=>$request->D624,
                "D51"=>$request->D51, "D52"=>$request->D52, "D53"=>$request->D53, "D54"=>$request->D54, "D55"=>$request->D55, "D56"=>$request->D56, "D57"=>$request->D57, "D58"=>$request->D58, "D59"=>$request->D59, "D510"=>$request->D510, "D511"=>$request->D511, "D512"=>$request->D512, "D513"=>$request->D513, "D514"=>$request->D514, "D515"=>$request->D515, "D516"=>$request->D516, "D517"=>$request->D517, "D518"=>$request->D518, "D519"=>$request->D519, "D520"=>$request->D520, "D521"=>$request->D521, "D522"=>$request->D522, "D523"=>$request->D523, "D524"=>$request->D524,
                "D31"=>$request->D31, "D32"=>$request->D32, "D33"=>$request->D33, "D34"=>$request->D34, "D35"=>$request->D35, "D36"=>$request->D36, "D37"=>$request->D37, "D38"=>$request->D38, "D39"=>$request->D39, "D310"=>$request->D310, "D311"=>$request->D311, "D312"=>$request->D312, "D313"=>$request->D313, "D314"=>$request->D314, "D315"=>$request->D315, "D316"=>$request->D316, "D317"=>$request->D317, "D318"=>$request->D318, "D319"=>$request->D319, "D320"=>$request->D320, "D321"=>$request->D321, "D322"=>$request->D322, "D323"=>$request->D323, "D324"=>$request->D324,
                "D11"=>$request->D11, "D12"=>$request->D12, "D13"=>$request->D13, "D14"=>$request->D14, "D15"=>$request->D15, "D16"=>$request->D16, "D17"=>$request->D17, "D18"=>$request->D18, "D19"=>$request->D19, "D110"=>$request->D110, "D111"=>$request->D111, "D112"=>$request->D112, "D113"=>$request->D113, "D114"=>$request->D114, "D115"=>$request->D115, "D116"=>$request->D116, "D117"=>$request->D117, "D118"=>$request->D118, "D119"=>$request->D119, "D120"=>$request->D120, "D121"=>$request->D121, "D122"=>$request->D122, "D123"=>$request->D123, "D124"=>$request->D124,
                "E91"=>$request->E91, "E92"=>$request->E92, "E93"=>$request->E93, "E94"=>$request->E94, "E95"=>$request->E95, "E96"=>$request->E96, "E97"=>$request->E97, "E98"=>$request->E98, "E99"=>$request->E99, "E910"=>$request->E910, "E911"=>$request->E911, "E912"=>$request->E912, "E913"=>$request->E913, "E914"=>$request->E914, "E915"=>$request->E915, "E916"=>$request->E916, "E917"=>$request->E917, "E918"=>$request->E918, "E919"=>$request->E919, "E920"=>$request->E920, "E921"=>$request->E921, "E922"=>$request->E922, "E923"=>$request->E923, "E924"=>$request->E924,
                "E81"=>$request->E81, "E82"=>$request->E82, "E83"=>$request->E83, "E84"=>$request->E84, "E85"=>$request->E85, "E86"=>$request->E86, "E87"=>$request->E87, "E88"=>$request->E88, "E89"=>$request->E89, "E810"=>$request->E810, "E811"=>$request->E811, "E812"=>$request->E812, "E813"=>$request->E813, "E814"=>$request->E814, "E815"=>$request->E815, "E816"=>$request->E816, "E817"=>$request->E817, "E818"=>$request->E818, "E819"=>$request->E819, "E820"=>$request->E820, "E821"=>$request->E821, "E822"=>$request->E822, "E823"=>$request->E823, "E824"=>$request->E824,
                "E71"=>$request->E71, "E72"=>$request->E72, "E73"=>$request->E73, "E74"=>$request->E74, "E75"=>$request->E75, "E76"=>$request->E76, "E77"=>$request->E77, "E78"=>$request->E78, "E79"=>$request->E79, "E710"=>$request->E710, "E711"=>$request->E711, "E712"=>$request->E712, "E713"=>$request->E713, "E714"=>$request->E714, "E715"=>$request->E715, "E716"=>$request->E716, "E717"=>$request->E717, "E718"=>$request->E718, "E719"=>$request->E719, "E720"=>$request->E720, "E721"=>$request->E721, "E722"=>$request->E722, "E723"=>$request->E723, "E724"=>$request->E724,
                "E61"=>$request->E61, "E62"=>$request->E62, "E63"=>$request->E63, "E64"=>$request->E64, "E65"=>$request->E65, "E66"=>$request->E66, "E67"=>$request->E67, "E68"=>$request->E68, "E69"=>$request->E69, "E610"=>$request->E610, "E611"=>$request->E611, "E612"=>$request->E612, "E613"=>$request->E613, "E614"=>$request->E614, "E615"=>$request->E615, "E616"=>$request->E616, "E617"=>$request->E617, "E618"=>$request->E618, "E619"=>$request->E619, "E620"=>$request->E620, "E621"=>$request->E621, "E622"=>$request->E622, "E623"=>$request->E623, "E624"=>$request->E624,
                "E51"=>$request->E51, "E52"=>$request->E52, "E53"=>$request->E53, "E54"=>$request->E54, "E55"=>$request->E55, "E56"=>$request->E56, "E57"=>$request->E57, "E58"=>$request->E58, "E59"=>$request->E59, "E510"=>$request->E510, "E511"=>$request->E511, "E512"=>$request->E512, "E513"=>$request->E513, "E514"=>$request->E514, "E515"=>$request->E515, "E516"=>$request->E516, "E517"=>$request->E517, "E518"=>$request->E518, "E519"=>$request->E519, "E520"=>$request->E520, "E521"=>$request->E521, "E522"=>$request->E522, "E523"=>$request->E523, "E524"=>$request->E524,
                "E31"=>$request->E31, "E32"=>$request->E32, "E33"=>$request->E33, "E34"=>$request->E34, "E35"=>$request->E35, "E36"=>$request->E36, "E37"=>$request->E37, "E38"=>$request->E38, "E39"=>$request->E39, "E310"=>$request->E310, "E311"=>$request->E311, "E312"=>$request->E312, "E313"=>$request->E313, "E314"=>$request->E314, "E315"=>$request->E315, "E316"=>$request->E316, "E317"=>$request->E317, "E318"=>$request->E318, "E319"=>$request->E319, "E320"=>$request->E320, "E321"=>$request->E321, "E322"=>$request->E322, "E323"=>$request->E323, "E324"=>$request->E324,
                "E11"=>$request->E11, "E12"=>$request->E12, "E13"=>$request->E13, "E14"=>$request->E14, "E15"=>$request->E15, "E16"=>$request->E16, "E17"=>$request->E17, "E18"=>$request->E18, "E19"=>$request->E19, "E110"=>$request->E110, "E111"=>$request->E111, "E112"=>$request->E112, "E113"=>$request->E113, "E114"=>$request->E114, "E115"=>$request->E115, "E116"=>$request->E116, "E117"=>$request->E117, "E118"=>$request->E118, "E119"=>$request->E119, "E120"=>$request->E120, "E121"=>$request->E121, "E122"=>$request->E122, "E123"=>$request->E123, "E124"=>$request->E124,
                "F91"=>$request->F91, "F92"=>$request->F92, "F93"=>$request->F93, "F94"=>$request->F94, "F95"=>$request->F95, "F96"=>$request->F96, "F97"=>$request->F97, "F98"=>$request->F98, "F99"=>$request->F99, "F910"=>$request->F910, "F911"=>$request->F911, "F912"=>$request->F912, "F913"=>$request->F913, "F914"=>$request->F914, "F915"=>$request->F915, "F916"=>$request->F916, "F917"=>$request->F917, "F918"=>$request->F918, "F919"=>$request->F919, "F920"=>$request->F920, "F921"=>$request->F921, "F922"=>$request->F922, "F923"=>$request->F923, "F924"=>$request->F924,
                "F81"=>$request->F81, "F82"=>$request->F82, "F83"=>$request->F83, "F84"=>$request->F84, "F85"=>$request->F85, "F86"=>$request->F86, "F87"=>$request->F87, "F88"=>$request->F88, "F89"=>$request->F89, "F810"=>$request->F810, "F811"=>$request->F811, "F812"=>$request->F812, "F813"=>$request->F813, "F814"=>$request->F814, "F815"=>$request->F815, "F816"=>$request->F816, "F817"=>$request->F817, "F818"=>$request->F818, "F819"=>$request->F819, "F820"=>$request->F820, "F821"=>$request->F821, "F822"=>$request->F822, "F823"=>$request->F823, "F824"=>$request->F824,
                "F71"=>$request->F71, "F72"=>$request->F72, "F73"=>$request->F73, "F74"=>$request->F74, "F75"=>$request->F75, "F76"=>$request->F76, "F77"=>$request->F77, "F78"=>$request->F78, "F79"=>$request->F79, "F710"=>$request->F710, "F711"=>$request->F711, "F712"=>$request->F712, "F713"=>$request->F713, "F714"=>$request->F714, "F715"=>$request->F715, "F716"=>$request->F716, "F717"=>$request->F717, "F718"=>$request->F718, "F719"=>$request->F719, "F720"=>$request->F720, "F721"=>$request->F721, "F722"=>$request->F722, "F723"=>$request->F723, "F724"=>$request->F724,
                "F61"=>$request->F61, "F62"=>$request->F62, "F63"=>$request->F63, "F64"=>$request->F64, "F65"=>$request->F65, "F66"=>$request->F66, "F67"=>$request->F67, "F68"=>$request->F68, "F69"=>$request->F69, "F610"=>$request->F610, "F611"=>$request->F611, "F612"=>$request->F612, "F613"=>$request->F613, "F614"=>$request->F614, "F615"=>$request->F615, "F616"=>$request->F616, "F617"=>$request->F617, "F618"=>$request->F618, "F619"=>$request->F619, "F620"=>$request->F620, "F621"=>$request->F621, "F622"=>$request->F622, "F623"=>$request->F623, "F624"=>$request->F624,
                "F51"=>$request->F51, "F52"=>$request->F52, "F53"=>$request->F53, "F54"=>$request->F54, "F55"=>$request->F55, "F56"=>$request->F56, "F57"=>$request->F57, "F58"=>$request->F58, "F59"=>$request->F59, "F510"=>$request->F510, "F511"=>$request->F511, "F512"=>$request->F512, "F513"=>$request->F513, "F514"=>$request->F514, "F515"=>$request->F515, "F516"=>$request->F516, "F517"=>$request->F517, "F518"=>$request->F518, "F519"=>$request->F519, "F520"=>$request->F520, "F521"=>$request->F521, "F522"=>$request->F522, "F523"=>$request->F523, "F524"=>$request->F524,
                "F31"=>$request->F31, "F32"=>$request->F32, "F33"=>$request->F33, "F34"=>$request->F34, "F35"=>$request->F35, "F36"=>$request->F36, "F37"=>$request->F37, "F38"=>$request->F38, "F39"=>$request->F39, "F310"=>$request->F310, "F311"=>$request->F311, "F312"=>$request->F312, "F313"=>$request->F313, "F314"=>$request->F314, "F315"=>$request->F315, "F316"=>$request->F316, "F317"=>$request->F317, "F318"=>$request->F318, "F319"=>$request->F319, "F320"=>$request->F320, "F321"=>$request->F321, "F322"=>$request->F322, "F323"=>$request->F323, "F324"=>$request->F324,
                "F11"=>$request->F11, "F12"=>$request->F12, "F13"=>$request->F13, "F14"=>$request->F14, "F15"=>$request->F15, "F16"=>$request->F16, "F17"=>$request->F17, "F18"=>$request->F18, "F19"=>$request->F19, "F110"=>$request->F110, "F111"=>$request->F111, "F112"=>$request->F112, "F113"=>$request->F113, "F114"=>$request->F114, "F115"=>$request->F115, "F116"=>$request->F116, "F117"=>$request->F117, "F118"=>$request->F118, "F119"=>$request->F119, "F120"=>$request->F120, "F121"=>$request->F121, "F122"=>$request->F122, "F123"=>$request->F123, "F124"=>$request->F124,
                 ]);

        }
        else{
            organoleptik::insert([
                "id_ppk"=> $id_ppk,"jenis"=>$jenis, "petugas"=>$request->petugas,
                "A91"=>$request->A91, "A92"=>$request->A92, "A93"=>$request->A93, "A94"=>$request->A94, "A95"=>$request->A95, "A96"=>$request->A96, "A97"=>$request->A97, "A98"=>$request->A98, "A99"=>$request->A99, "A910"=>$request->A910, "A911"=>$request->A911, "A912"=>$request->A912, "A913"=>$request->A913, "A914"=>$request->A914, "A915"=>$request->A915, "A916"=>$request->A916, "A917"=>$request->A917, "A918"=>$request->A918, "A919"=>$request->A919, "A920"=>$request->A920, "A921"=>$request->A921, "A922"=>$request->A922, "A923"=>$request->A923, "A924"=>$request->A924,
                "A81"=>$request->A81, "A82"=>$request->A82, "A83"=>$request->A83, "A84"=>$request->A84, "A85"=>$request->A85, "A86"=>$request->A86, "A87"=>$request->A87, "A88"=>$request->A88, "A89"=>$request->A89, "A810"=>$request->A810, "A811"=>$request->A811, "A812"=>$request->A812, "A813"=>$request->A813, "A814"=>$request->A814, "A815"=>$request->A815, "A816"=>$request->A816, "A817"=>$request->A817, "A818"=>$request->A818, "A819"=>$request->A819, "A820"=>$request->A820, "A821"=>$request->A821, "A822"=>$request->A822, "A823"=>$request->A823, "A824"=>$request->A824,
                "A71"=>$request->A71, "A72"=>$request->A72, "A73"=>$request->A73, "A74"=>$request->A74, "A75"=>$request->A75, "A76"=>$request->A76, "A77"=>$request->A77, "A78"=>$request->A78, "A79"=>$request->A79, "A710"=>$request->A710, "A711"=>$request->A711, "A712"=>$request->A712, "A713"=>$request->A713, "A714"=>$request->A714, "A715"=>$request->A715, "A716"=>$request->A716, "A717"=>$request->A717, "A718"=>$request->A718, "A719"=>$request->A719, "A720"=>$request->A720, "A721"=>$request->A721, "A722"=>$request->A722, "A723"=>$request->A723, "A724"=>$request->A724,
                "A61"=>$request->A61, "A62"=>$request->A62, "A63"=>$request->A63, "A64"=>$request->A64, "A65"=>$request->A65, "A66"=>$request->A66, "A67"=>$request->A67, "A68"=>$request->A68, "A69"=>$request->A69, "A610"=>$request->A610, "A611"=>$request->A611, "A612"=>$request->A612, "A613"=>$request->A613, "A614"=>$request->A614, "A615"=>$request->A615, "A616"=>$request->A616, "A617"=>$request->A617, "A618"=>$request->A618, "A619"=>$request->A619, "A620"=>$request->A620, "A621"=>$request->A621, "A622"=>$request->A622, "A623"=>$request->A623, "A624"=>$request->A624,
                "A51"=>$request->A51, "A52"=>$request->A52, "A53"=>$request->A53, "A54"=>$request->A54, "A55"=>$request->A55, "A56"=>$request->A56, "A57"=>$request->A57, "A58"=>$request->A58, "A59"=>$request->A59, "A510"=>$request->A510, "A511"=>$request->A511, "A512"=>$request->A512, "A513"=>$request->A513, "A514"=>$request->A514, "A515"=>$request->A515, "A516"=>$request->A516, "A517"=>$request->A517, "A518"=>$request->A518, "A519"=>$request->A519, "A520"=>$request->A520, "A521"=>$request->A521, "A522"=>$request->A522, "A523"=>$request->A523, "A524"=>$request->A524,
                "A31"=>$request->A31, "A32"=>$request->A32, "A33"=>$request->A33, "A34"=>$request->A34, "A35"=>$request->A35, "A36"=>$request->A36, "A37"=>$request->A37, "A38"=>$request->A38, "A39"=>$request->A39, "A310"=>$request->A310, "A311"=>$request->A311, "A312"=>$request->A312, "A313"=>$request->A313, "A314"=>$request->A314, "A315"=>$request->A315, "A316"=>$request->A316, "A317"=>$request->A317, "A318"=>$request->A318, "A319"=>$request->A319, "A320"=>$request->A320, "A321"=>$request->A321, "A322"=>$request->A322, "A323"=>$request->A323, "A324"=>$request->A324,
                "A11"=>$request->A11, "A12"=>$request->A12, "A13"=>$request->A13, "A14"=>$request->A14, "A15"=>$request->A15, "A16"=>$request->A16, "A17"=>$request->A17, "A18"=>$request->A18, "A19"=>$request->A19, "A110"=>$request->A110, "A111"=>$request->A111, "A112"=>$request->A112, "A113"=>$request->A113, "A114"=>$request->A114, "A115"=>$request->A115, "A116"=>$request->A116, "A117"=>$request->A117, "A118"=>$request->A118, "A119"=>$request->A119, "A120"=>$request->A120, "A121"=>$request->A121, "A122"=>$request->A122, "A123"=>$request->A123, "A124"=>$request->A124,
                "B91"=>$request->B91, "B92"=>$request->B92, "B93"=>$request->B93, "B94"=>$request->B94, "B95"=>$request->B95, "B96"=>$request->B96, "B97"=>$request->B97, "B98"=>$request->B98, "B99"=>$request->B99, "B910"=>$request->B910, "B911"=>$request->B911, "B912"=>$request->B912, "B913"=>$request->B913, "B914"=>$request->B914, "B915"=>$request->B915, "B916"=>$request->B916, "B917"=>$request->B917, "B918"=>$request->B918, "B919"=>$request->B919, "B920"=>$request->B920, "B921"=>$request->B921, "B922"=>$request->B922, "B923"=>$request->B923, "B924"=>$request->B924,
                "B81"=>$request->B81, "B82"=>$request->B82, "B83"=>$request->B83, "B84"=>$request->B84, "B85"=>$request->B85, "B86"=>$request->B86, "B87"=>$request->B87, "B88"=>$request->B88, "B89"=>$request->B89, "B810"=>$request->B810, "B811"=>$request->B811, "B812"=>$request->B812, "B813"=>$request->B813, "B814"=>$request->B814, "B815"=>$request->B815, "B816"=>$request->B816, "B817"=>$request->B817, "B818"=>$request->B818, "B819"=>$request->B819, "B820"=>$request->B820, "B821"=>$request->B821, "B822"=>$request->B822, "B823"=>$request->B823, "B824"=>$request->B824,
                "B71"=>$request->B71, "B72"=>$request->B72, "B73"=>$request->B73, "B74"=>$request->B74, "B75"=>$request->B75, "B76"=>$request->B76, "B77"=>$request->B77, "B78"=>$request->B78, "B79"=>$request->B79, "B710"=>$request->B710, "B711"=>$request->B711, "B712"=>$request->B712, "B713"=>$request->B713, "B714"=>$request->B714, "B715"=>$request->B715, "B716"=>$request->B716, "B717"=>$request->B717, "B718"=>$request->B718, "B719"=>$request->B719, "B720"=>$request->B720, "B721"=>$request->B721, "B722"=>$request->B722, "B723"=>$request->B723, "B724"=>$request->B724,
                "B61"=>$request->B61, "B62"=>$request->B62, "B63"=>$request->B63, "B64"=>$request->B64, "B65"=>$request->B65, "B66"=>$request->B66, "B67"=>$request->B67, "B68"=>$request->B68, "B69"=>$request->B69, "B610"=>$request->B610, "B611"=>$request->B611, "B612"=>$request->B612, "B613"=>$request->B613, "B614"=>$request->B614, "B615"=>$request->B615, "B616"=>$request->B616, "B617"=>$request->B617, "B618"=>$request->B618, "B619"=>$request->B619, "B620"=>$request->B620, "B621"=>$request->B621, "B622"=>$request->B622, "B623"=>$request->B623, "B624"=>$request->B624,
                "B51"=>$request->B51, "B52"=>$request->B52, "B53"=>$request->B53, "B54"=>$request->B54, "B55"=>$request->B55, "B56"=>$request->B56, "B57"=>$request->B57, "B58"=>$request->B58, "B59"=>$request->B59, "B510"=>$request->B510, "B511"=>$request->B511, "B512"=>$request->B512, "B513"=>$request->B513, "B514"=>$request->B514, "B515"=>$request->B515, "B516"=>$request->B516, "B517"=>$request->B517, "B518"=>$request->B518, "B519"=>$request->B519, "B520"=>$request->B520, "B521"=>$request->B521, "B522"=>$request->B522, "B523"=>$request->B523, "B524"=>$request->B524,
                "B31"=>$request->B31, "B32"=>$request->B32, "B33"=>$request->B33, "B34"=>$request->B34, "B35"=>$request->B35, "B36"=>$request->B36, "B37"=>$request->B37, "B38"=>$request->B38, "B39"=>$request->B39, "B310"=>$request->B310, "B311"=>$request->B311, "B312"=>$request->B312, "B313"=>$request->B313, "B314"=>$request->B314, "B315"=>$request->B315, "B316"=>$request->B316, "B317"=>$request->B317, "B318"=>$request->B318, "B319"=>$request->B319, "B320"=>$request->B320, "B321"=>$request->B321, "B322"=>$request->B322, "B323"=>$request->B323, "B324"=>$request->B324,
                "B11"=>$request->B11, "B12"=>$request->B12, "B13"=>$request->B13, "B14"=>$request->B14, "B15"=>$request->B15, "B16"=>$request->B16, "B17"=>$request->B17, "B18"=>$request->B18, "B19"=>$request->B19, "B110"=>$request->B110, "B111"=>$request->B111, "B112"=>$request->B112, "B113"=>$request->B113, "B114"=>$request->B114, "B115"=>$request->B115, "B116"=>$request->B116, "B117"=>$request->B117, "B118"=>$request->B118, "B119"=>$request->B119, "B120"=>$request->B120, "B121"=>$request->B121, "B122"=>$request->B122, "B123"=>$request->B123, "B124"=>$request->B124, 
                "C91"=>$request->C91, "C92"=>$request->C92, "C93"=>$request->C93, "C94"=>$request->C94, "C95"=>$request->C95, "C96"=>$request->C96, "C97"=>$request->C97, "C98"=>$request->C98, "C99"=>$request->C99, "C910"=>$request->C910, "C911"=>$request->C911, "C912"=>$request->C912, "C913"=>$request->C913, "C914"=>$request->C914, "C915"=>$request->C915, "C916"=>$request->C916, "C917"=>$request->C917, "C918"=>$request->C918, "C919"=>$request->C919, "C920"=>$request->C920, "C921"=>$request->C921, "C922"=>$request->C922, "C923"=>$request->C923, "C924"=>$request->C924,
                "C81"=>$request->C81, "C82"=>$request->C82, "C83"=>$request->C83, "C84"=>$request->C84, "C85"=>$request->C85, "C86"=>$request->C86, "C87"=>$request->C87, "C88"=>$request->C88, "C89"=>$request->C89, "C810"=>$request->C810, "C811"=>$request->C811, "C812"=>$request->C812, "C813"=>$request->C813, "C814"=>$request->C814, "C815"=>$request->C815, "C816"=>$request->C816, "C817"=>$request->C817, "C818"=>$request->C818, "C819"=>$request->C819, "C820"=>$request->C820, "C821"=>$request->C821, "C822"=>$request->C822, "C823"=>$request->C823, "C824"=>$request->C824,
                "C71"=>$request->C71, "C72"=>$request->C72, "C73"=>$request->C73, "C74"=>$request->C74, "C75"=>$request->C75, "C76"=>$request->C76, "C77"=>$request->C77, "C78"=>$request->C78, "C79"=>$request->C79, "C710"=>$request->C710, "C711"=>$request->C711, "C712"=>$request->C712, "C713"=>$request->C713, "C714"=>$request->C714, "C715"=>$request->C715, "C716"=>$request->C716, "C717"=>$request->C717, "C718"=>$request->C718, "C719"=>$request->C719, "C720"=>$request->C720, "C721"=>$request->C721, "C722"=>$request->C722, "C723"=>$request->C723, "C724"=>$request->C724,
                "C61"=>$request->C61, "C62"=>$request->C62, "C63"=>$request->C63, "C64"=>$request->C64, "C65"=>$request->C65, "C66"=>$request->C66, "C67"=>$request->C67, "C68"=>$request->C68, "C69"=>$request->C69, "C610"=>$request->C610, "C611"=>$request->C611, "C612"=>$request->C612, "C613"=>$request->C613, "C614"=>$request->C614, "C615"=>$request->C615, "C616"=>$request->C616, "C617"=>$request->C617, "C618"=>$request->C618, "C619"=>$request->C619, "C620"=>$request->C620, "C621"=>$request->C621, "C622"=>$request->C622, "C623"=>$request->C623, "C624"=>$request->C624,
                "C51"=>$request->C51, "C52"=>$request->C52, "C53"=>$request->C53, "C54"=>$request->C54, "C55"=>$request->C55, "C56"=>$request->C56, "C57"=>$request->C57, "C58"=>$request->C58, "C59"=>$request->C59, "C510"=>$request->C510, "C511"=>$request->C511, "C512"=>$request->C512, "C513"=>$request->C513, "C514"=>$request->C514, "C515"=>$request->C515, "C516"=>$request->C516, "C517"=>$request->C517, "C518"=>$request->C518, "C519"=>$request->C519, "C520"=>$request->C520, "C521"=>$request->C521, "C522"=>$request->C522, "C523"=>$request->C523, "C524"=>$request->C524,
                "C31"=>$request->C31, "C32"=>$request->C32, "C33"=>$request->C33, "C34"=>$request->C34, "C35"=>$request->C35, "C36"=>$request->C36, "C37"=>$request->C37, "C38"=>$request->C38, "C39"=>$request->C39, "C310"=>$request->C310, "C311"=>$request->C311, "C312"=>$request->C312, "C313"=>$request->C313, "C314"=>$request->C314, "C315"=>$request->C315, "C316"=>$request->C316, "C317"=>$request->C317, "C318"=>$request->C318, "C319"=>$request->C319, "C320"=>$request->C320, "C321"=>$request->C321, "C322"=>$request->C322, "C323"=>$request->C323, "C324"=>$request->C324,
                "C11"=>$request->C11, "C12"=>$request->C12, "C13"=>$request->C13, "C14"=>$request->C14, "C15"=>$request->C15, "C16"=>$request->C16, "C17"=>$request->C17, "C18"=>$request->C18, "C19"=>$request->C19, "C110"=>$request->C110, "C111"=>$request->C111, "C112"=>$request->C112, "C113"=>$request->C113, "C114"=>$request->C114, "C115"=>$request->C115, "C116"=>$request->C116, "C117"=>$request->C117, "C118"=>$request->C118, "C119"=>$request->C119, "C120"=>$request->C120, "C121"=>$request->C121, "C122"=>$request->C122, "C123"=>$request->C123, "C124"=>$request->C124,
                "D91"=>$request->D91, "D92"=>$request->D92, "D93"=>$request->D93, "D94"=>$request->D94, "D95"=>$request->D95, "D96"=>$request->D96, "D97"=>$request->D97, "D98"=>$request->D98, "D99"=>$request->D99, "D910"=>$request->D910, "D911"=>$request->D911, "D912"=>$request->D912, "D913"=>$request->D913, "D914"=>$request->D914, "D915"=>$request->D915, "D916"=>$request->D916, "D917"=>$request->D917, "D918"=>$request->D918, "D919"=>$request->D919, "D920"=>$request->D920, "D921"=>$request->D921, "D922"=>$request->D922, "D923"=>$request->D923, "D924"=>$request->D924,
                "D81"=>$request->D81, "D82"=>$request->D82, "D83"=>$request->D83, "D84"=>$request->D84, "D85"=>$request->D85, "D86"=>$request->D86, "D87"=>$request->D87, "D88"=>$request->D88, "D89"=>$request->D89, "D810"=>$request->D810, "D811"=>$request->D811, "D812"=>$request->D812, "D813"=>$request->D813, "D814"=>$request->D814, "D815"=>$request->D815, "D816"=>$request->D816, "D817"=>$request->D817, "D818"=>$request->D818, "D819"=>$request->D819, "D820"=>$request->D820, "D821"=>$request->D821, "D822"=>$request->D822, "D823"=>$request->D823, "D824"=>$request->D824,
                "D71"=>$request->D71, "D72"=>$request->D72, "D73"=>$request->D73, "D74"=>$request->D74, "D75"=>$request->D75, "D76"=>$request->D76, "D77"=>$request->D77, "D78"=>$request->D78, "D79"=>$request->D79, "D710"=>$request->D710, "D711"=>$request->D711, "D712"=>$request->D712, "D713"=>$request->D713, "D714"=>$request->D714, "D715"=>$request->D715, "D716"=>$request->D716, "D717"=>$request->D717, "D718"=>$request->D718, "D719"=>$request->D719, "D720"=>$request->D720, "D721"=>$request->D721, "D722"=>$request->D722, "D723"=>$request->D723, "D724"=>$request->D724,
                "D61"=>$request->D61, "D62"=>$request->D62, "D63"=>$request->D63, "D64"=>$request->D64, "D65"=>$request->D65, "D66"=>$request->D66, "D67"=>$request->D67, "D68"=>$request->D68, "D69"=>$request->D69, "D610"=>$request->D610, "D611"=>$request->D611, "D612"=>$request->D612, "D613"=>$request->D613, "D614"=>$request->D614, "D615"=>$request->D615, "D616"=>$request->D616, "D617"=>$request->D617, "D618"=>$request->D618, "D619"=>$request->D619, "D620"=>$request->D620, "D621"=>$request->D621, "D622"=>$request->D622, "D623"=>$request->D623, "D624"=>$request->D624,
                "D51"=>$request->D51, "D52"=>$request->D52, "D53"=>$request->D53, "D54"=>$request->D54, "D55"=>$request->D55, "D56"=>$request->D56, "D57"=>$request->D57, "D58"=>$request->D58, "D59"=>$request->D59, "D510"=>$request->D510, "D511"=>$request->D511, "D512"=>$request->D512, "D513"=>$request->D513, "D514"=>$request->D514, "D515"=>$request->D515, "D516"=>$request->D516, "D517"=>$request->D517, "D518"=>$request->D518, "D519"=>$request->D519, "D520"=>$request->D520, "D521"=>$request->D521, "D522"=>$request->D522, "D523"=>$request->D523, "D524"=>$request->D524,
                "D31"=>$request->D31, "D32"=>$request->D32, "D33"=>$request->D33, "D34"=>$request->D34, "D35"=>$request->D35, "D36"=>$request->D36, "D37"=>$request->D37, "D38"=>$request->D38, "D39"=>$request->D39, "D310"=>$request->D310, "D311"=>$request->D311, "D312"=>$request->D312, "D313"=>$request->D313, "D314"=>$request->D314, "D315"=>$request->D315, "D316"=>$request->D316, "D317"=>$request->D317, "D318"=>$request->D318, "D319"=>$request->D319, "D320"=>$request->D320, "D321"=>$request->D321, "D322"=>$request->D322, "D323"=>$request->D323, "D324"=>$request->D324,
                "D11"=>$request->D11, "D12"=>$request->D12, "D13"=>$request->D13, "D14"=>$request->D14, "D15"=>$request->D15, "D16"=>$request->D16, "D17"=>$request->D17, "D18"=>$request->D18, "D19"=>$request->D19, "D110"=>$request->D110, "D111"=>$request->D111, "D112"=>$request->D112, "D113"=>$request->D113, "D114"=>$request->D114, "D115"=>$request->D115, "D116"=>$request->D116, "D117"=>$request->D117, "D118"=>$request->D118, "D119"=>$request->D119, "D120"=>$request->D120, "D121"=>$request->D121, "D122"=>$request->D122, "D123"=>$request->D123, "D124"=>$request->D124,
                "E91"=>$request->E91, "E92"=>$request->E92, "E93"=>$request->E93, "E94"=>$request->E94, "E95"=>$request->E95, "E96"=>$request->E96, "E97"=>$request->E97, "E98"=>$request->E98, "E99"=>$request->E99, "E910"=>$request->E910, "E911"=>$request->E911, "E912"=>$request->E912, "E913"=>$request->E913, "E914"=>$request->E914, "E915"=>$request->E915, "E916"=>$request->E916, "E917"=>$request->E917, "E918"=>$request->E918, "E919"=>$request->E919, "E920"=>$request->E920, "E921"=>$request->E921, "E922"=>$request->E922, "E923"=>$request->E923, "E924"=>$request->E924,
                "E81"=>$request->E81, "E82"=>$request->E82, "E83"=>$request->E83, "E84"=>$request->E84, "E85"=>$request->E85, "E86"=>$request->E86, "E87"=>$request->E87, "E88"=>$request->E88, "E89"=>$request->E89, "E810"=>$request->E810, "E811"=>$request->E811, "E812"=>$request->E812, "E813"=>$request->E813, "E814"=>$request->E814, "E815"=>$request->E815, "E816"=>$request->E816, "E817"=>$request->E817, "E818"=>$request->E818, "E819"=>$request->E819, "E820"=>$request->E820, "E821"=>$request->E821, "E822"=>$request->E822, "E823"=>$request->E823, "E824"=>$request->E824,
                "E71"=>$request->E71, "E72"=>$request->E72, "E73"=>$request->E73, "E74"=>$request->E74, "E75"=>$request->E75, "E76"=>$request->E76, "E77"=>$request->E77, "E78"=>$request->E78, "E79"=>$request->E79, "E710"=>$request->E710, "E711"=>$request->E711, "E712"=>$request->E712, "E713"=>$request->E713, "E714"=>$request->E714, "E715"=>$request->E715, "E716"=>$request->E716, "E717"=>$request->E717, "E718"=>$request->E718, "E719"=>$request->E719, "E720"=>$request->E720, "E721"=>$request->E721, "E722"=>$request->E722, "E723"=>$request->E723, "E724"=>$request->E724,
                "E61"=>$request->E61, "E62"=>$request->E62, "E63"=>$request->E63, "E64"=>$request->E64, "E65"=>$request->E65, "E66"=>$request->E66, "E67"=>$request->E67, "E68"=>$request->E68, "E69"=>$request->E69, "E610"=>$request->E610, "E611"=>$request->E611, "E612"=>$request->E612, "E613"=>$request->E613, "E614"=>$request->E614, "E615"=>$request->E615, "E616"=>$request->E616, "E617"=>$request->E617, "E618"=>$request->E618, "E619"=>$request->E619, "E620"=>$request->E620, "E621"=>$request->E621, "E622"=>$request->E622, "E623"=>$request->E623, "E624"=>$request->E624,
                "E51"=>$request->E51, "E52"=>$request->E52, "E53"=>$request->E53, "E54"=>$request->E54, "E55"=>$request->E55, "E56"=>$request->E56, "E57"=>$request->E57, "E58"=>$request->E58, "E59"=>$request->E59, "E510"=>$request->E510, "E511"=>$request->E511, "E512"=>$request->E512, "E513"=>$request->E513, "E514"=>$request->E514, "E515"=>$request->E515, "E516"=>$request->E516, "E517"=>$request->E517, "E518"=>$request->E518, "E519"=>$request->E519, "E520"=>$request->E520, "E521"=>$request->E521, "E522"=>$request->E522, "E523"=>$request->E523, "E524"=>$request->E524,
                "E31"=>$request->E31, "E32"=>$request->E32, "E33"=>$request->E33, "E34"=>$request->E34, "E35"=>$request->E35, "E36"=>$request->E36, "E37"=>$request->E37, "E38"=>$request->E38, "E39"=>$request->E39, "E310"=>$request->E310, "E311"=>$request->E311, "E312"=>$request->E312, "E313"=>$request->E313, "E314"=>$request->E314, "E315"=>$request->E315, "E316"=>$request->E316, "E317"=>$request->E317, "E318"=>$request->E318, "E319"=>$request->E319, "E320"=>$request->E320, "E321"=>$request->E321, "E322"=>$request->E322, "E323"=>$request->E323, "E324"=>$request->E324,
                "E11"=>$request->E11, "E12"=>$request->E12, "E13"=>$request->E13, "E14"=>$request->E14, "E15"=>$request->E15, "E16"=>$request->E16, "E17"=>$request->E17, "E18"=>$request->E18, "E19"=>$request->E19, "E110"=>$request->E110, "E111"=>$request->E111, "E112"=>$request->E112, "E113"=>$request->E113, "E114"=>$request->E114, "E115"=>$request->E115, "E116"=>$request->E116, "E117"=>$request->E117, "E118"=>$request->E118, "E119"=>$request->E119, "E120"=>$request->E120, "E121"=>$request->E121, "E122"=>$request->E122, "E123"=>$request->E123, "E124"=>$request->E124,
                "F91"=>$request->F91, "F92"=>$request->F92, "F93"=>$request->F93, "F94"=>$request->F94, "F95"=>$request->F95, "F96"=>$request->F96, "F97"=>$request->F97, "F98"=>$request->F98, "F99"=>$request->F99, "F910"=>$request->F910, "F911"=>$request->F911, "F912"=>$request->F912, "F913"=>$request->F913, "F914"=>$request->F914, "F915"=>$request->F915, "F916"=>$request->F916, "F917"=>$request->F917, "F918"=>$request->F918, "F919"=>$request->F919, "F920"=>$request->F920, "F921"=>$request->F921, "F922"=>$request->F922, "F923"=>$request->F923, "F924"=>$request->F924,
                "F81"=>$request->F81, "F82"=>$request->F82, "F83"=>$request->F83, "F84"=>$request->F84, "F85"=>$request->F85, "F86"=>$request->F86, "F87"=>$request->F87, "F88"=>$request->F88, "F89"=>$request->F89, "F810"=>$request->F810, "F811"=>$request->F811, "F812"=>$request->F812, "F813"=>$request->F813, "F814"=>$request->F814, "F815"=>$request->F815, "F816"=>$request->F816, "F817"=>$request->F817, "F818"=>$request->F818, "F819"=>$request->F819, "F820"=>$request->F820, "F821"=>$request->F821, "F822"=>$request->F822, "F823"=>$request->F823, "F824"=>$request->F824,
                "F71"=>$request->F71, "F72"=>$request->F72, "F73"=>$request->F73, "F74"=>$request->F74, "F75"=>$request->F75, "F76"=>$request->F76, "F77"=>$request->F77, "F78"=>$request->F78, "F79"=>$request->F79, "F710"=>$request->F710, "F711"=>$request->F711, "F712"=>$request->F712, "F713"=>$request->F713, "F714"=>$request->F714, "F715"=>$request->F715, "F716"=>$request->F716, "F717"=>$request->F717, "F718"=>$request->F718, "F719"=>$request->F719, "F720"=>$request->F720, "F721"=>$request->F721, "F722"=>$request->F722, "F723"=>$request->F723, "F724"=>$request->F724,
                "F61"=>$request->F61, "F62"=>$request->F62, "F63"=>$request->F63, "F64"=>$request->F64, "F65"=>$request->F65, "F66"=>$request->F66, "F67"=>$request->F67, "F68"=>$request->F68, "F69"=>$request->F69, "F610"=>$request->F610, "F611"=>$request->F611, "F612"=>$request->F612, "F613"=>$request->F613, "F614"=>$request->F614, "F615"=>$request->F615, "F616"=>$request->F616, "F617"=>$request->F617, "F618"=>$request->F618, "F619"=>$request->F619, "F620"=>$request->F620, "F621"=>$request->F621, "F622"=>$request->F622, "F623"=>$request->F623, "F624"=>$request->F624,
                "F51"=>$request->F51, "F52"=>$request->F52, "F53"=>$request->F53, "F54"=>$request->F54, "F55"=>$request->F55, "F56"=>$request->F56, "F57"=>$request->F57, "F58"=>$request->F58, "F59"=>$request->F59, "F510"=>$request->F510, "F511"=>$request->F511, "F512"=>$request->F512, "F513"=>$request->F513, "F514"=>$request->F514, "F515"=>$request->F515, "F516"=>$request->F516, "F517"=>$request->F517, "F518"=>$request->F518, "F519"=>$request->F519, "F520"=>$request->F520, "F521"=>$request->F521, "F522"=>$request->F522, "F523"=>$request->F523, "F524"=>$request->F524,
                "F31"=>$request->F31, "F32"=>$request->F32, "F33"=>$request->F33, "F34"=>$request->F34, "F35"=>$request->F35, "F36"=>$request->F36, "F37"=>$request->F37, "F38"=>$request->F38, "F39"=>$request->F39, "F310"=>$request->F310, "F311"=>$request->F311, "F312"=>$request->F312, "F313"=>$request->F313, "F314"=>$request->F314, "F315"=>$request->F315, "F316"=>$request->F316, "F317"=>$request->F317, "F318"=>$request->F318, "F319"=>$request->F319, "F320"=>$request->F320, "F321"=>$request->F321, "F322"=>$request->F322, "F323"=>$request->F323, "F324"=>$request->F324,
                "F11"=>$request->F11, "F12"=>$request->F12, "F13"=>$request->F13, "F14"=>$request->F14, "F15"=>$request->F15, "F16"=>$request->F16, "F17"=>$request->F17, "F18"=>$request->F18, "F19"=>$request->F19, "F110"=>$request->F110, "F111"=>$request->F111, "F112"=>$request->F112, "F113"=>$request->F113, "F114"=>$request->F114, "F115"=>$request->F115, "F116"=>$request->F116, "F117"=>$request->F117, "F118"=>$request->F118, "F119"=>$request->F119, "F120"=>$request->F120, "F121"=>$request->F121, "F122"=>$request->F122, "F123"=>$request->F123, "F124"=>$request->F124,
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


        return view('admin.organoleptikprint',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            'jenis'=>$jenis,
            'id_ppk'=>$id_ppk
            
        ]);
    }

    public function edit(Request $request){

        $jenis = request()->segment(4);
        // $ada = DB::connection('sqlsrv2')->table('organoleptik')
        //     ->where('id_ppk',$id_ppk)
        //     ->where('jenis', $jenis)
        //     ->select('*')
        //     ->get();

        // if(count($ada) > 0){
        //     organoleptik::where('id_ppk', $id_ppk)->where('jenis', $jenis)->delete();
        // }
        // $list = DB::connection('sqlsrv2')->table('v_data_header')
        //     ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
        //     ->get();

        // $header = DB::connection('sqlsrv2')->table('v_data_header')
        //     ->where('id_ppk',$id_ppk)
        //     ->select('id_ppk', 'no_ppk', 'nm_trader', 'tgl_ppk')
        //     ->get();



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
                "parameter51"=>$request->parameter51, "parameter52"=>$request->parameter52, "parameter53"=>$request->parameter53, "parameter54"=>$request->parameter54, "parameter55"=>$request->parameter55, "parameter56"=>$request->parameter56, "parameter57"=>$request->parameter57, "parameter58"=>$request->parameter58, "parameter59"=>$request->parameter59, "parameter60"=>$request->parameter60,
                "nilai1"=>$request->nilai1, "nilai2"=>$request->nilai2, "nilai3"=>$request->nilai3, "nilai4"=>$request->nilai4, "nilai5"=>$request->nilai5, "nilai6"=>$request->nilai6, "nilai7"=>$request->nilai7, "nilai8"=>$request->nilai8, "nilai9"=>$request->nilai9, "nilai10"=>$request->nilai10,
                "nilai11"=>$request->nilai11, "nilai12"=>$request->nilai12, "nilai13"=>$request->nilai13, "nilai14"=>$request->nilai14, "nilai15"=>$request->nilai15, "nilai16"=>$request->nilai16, "nilai17"=>$request->nilai17, "nilai18"=>$request->nilai18, "nilai19"=>$request->nilai19, "nilai20"=>$request->nilai20,
                "nilai21"=>$request->nilai21, "nilai22"=>$request->nilai22, "nilai23"=>$request->nilai23, "nilai24"=>$request->nilai24, "nilai25"=>$request->nilai25, "nilai26"=>$request->nilai26, "nilai27"=>$request->nilai27, "nilai28"=>$request->nilai28, "nilai29"=>$request->nilai29, "nilai30"=>$request->nilai30,
                "nilai31"=>$request->nilai31, "nilai32"=>$request->nilai32, "nilai33"=>$request->nilai33, "nilai34"=>$request->nilai34, "nilai35"=>$request->nilai35, "nilai36"=>$request->nilai36, "nilai37"=>$request->nilai37, "nilai38"=>$request->nilai38, "nilai39"=>$request->nilai39, "nilai40"=>$request->nilai40,
                "nilai41"=>$request->nilai41, "nilai42"=>$request->nilai42, "nilai43"=>$request->nilai43, "nilai44"=>$request->nilai44, "nilai45"=>$request->nilai45, "nilai46"=>$request->nilai46, "nilai47"=>$request->nilai47, "nilai48"=>$request->nilai48, "nilai49"=>$request->nilai49, "nilai50"=>$request->nilai50,
                "nilai51"=>$request->nilai51, "nilai52"=>$request->nilai52, "nilai53"=>$request->nilai53, "nilai54"=>$request->nilai54, "nilai55"=>$request->nilai55, "nilai56"=>$request->nilai56, "nilai57"=>$request->nilai57, "nilai58"=>$request->nilai58, "nilai59"=>$request->nilai59, "nilai60"=>$request->nilai60,
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
                "parameter51"=>$request->parameter51, "parameter52"=>$request->parameter52, "parameter53"=>$request->parameter53, "parameter54"=>$request->parameter54, "parameter55"=>$request->parameter55, "parameter56"=>$request->parameter56, "parameter57"=>$request->parameter57, "parameter58"=>$request->parameter58, "parameter59"=>$request->parameter59, "parameter60"=>$request->parameter60,
                "nilai1"=>$request->nilai1, "nilai2"=>$request->nilai2, "nilai3"=>$request->nilai3, "nilai4"=>$request->nilai4, "nilai5"=>$request->nilai5, "nilai6"=>$request->nilai6, "nilai7"=>$request->nilai7, "nilai8"=>$request->nilai8, "nilai9"=>$request->nilai9, "nilai10"=>$request->nilai10,
                "nilai11"=>$request->nilai11, "nilai12"=>$request->nilai12, "nilai13"=>$request->nilai13, "nilai14"=>$request->nilai14, "nilai15"=>$request->nilai15, "nilai16"=>$request->nilai16, "nilai17"=>$request->nilai17, "nilai18"=>$request->nilai18, "nilai19"=>$request->nilai19, "nilai20"=>$request->nilai20,
                "nilai21"=>$request->nilai21, "nilai22"=>$request->nilai22, "nilai23"=>$request->nilai23, "nilai24"=>$request->nilai24, "nilai25"=>$request->nilai25, "nilai26"=>$request->nilai26, "nilai27"=>$request->nilai27, "nilai28"=>$request->nilai28, "nilai29"=>$request->nilai29, "nilai30"=>$request->nilai30,
                "nilai31"=>$request->nilai31, "nilai32"=>$request->nilai32, "nilai33"=>$request->nilai33, "nilai34"=>$request->nilai34, "nilai35"=>$request->nilai35, "nilai36"=>$request->nilai36, "nilai37"=>$request->nilai37, "nilai38"=>$request->nilai38, "nilai39"=>$request->nilai39, "nilai40"=>$request->nilai40,
                "nilai41"=>$request->nilai41, "nilai42"=>$request->nilai42, "nilai43"=>$request->nilai43, "nilai44"=>$request->nilai44, "nilai45"=>$request->nilai45, "nilai46"=>$request->nilai46, "nilai47"=>$request->nilai47, "nilai48"=>$request->nilai48, "nilai49"=>$request->nilai49, "nilai50"=>$request->nilai50,
                "nilai51"=>$request->nilai51, "nilai52"=>$request->nilai52, "nilai53"=>$request->nilai53, "nilai54"=>$request->nilai54, "nilai55"=>$request->nilai55, "nilai56"=>$request->nilai56, "nilai57"=>$request->nilai57, "nilai58"=>$request->nilai58, "nilai59"=>$request->nilai59, "nilai60"=>$request->nilai60,
            ]);
        }
        return redirect('/admin/organoleptik')->with('berhasilSimpan','Data berhasil disimpan');
    }

    public function NilaiOrganoleptik2(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);

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
            ->select('*')
            ->get();


        return view('admin.organoleptik',[
            'title'=>'Organoleptik',
            'list'=>$list,
            'header'=>$header,
            'check' => ($check->isNotEmpty()) ? $check : null,
            'jenis'=>$jenis,
            'id_ppk'=>$id_ppk
            
        ]);
    }
    
    public function submit2(Request $request){

        $id_ppk = request()->segment(3);
        $jenis = request()->segment(4);

        $ada = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->select('*')
            ->get();

        $nilai = DB::connection('sqlsrv2')->table('organoleptik')
            ->where('id_ppk',$id_ppk)
            ->where('jenis',$jenis)
            ->select('*')
            ->get();
        $nilaibaru=$nilai.'';


        if(count($ada) > 0){
            organoleptik::where('id_ppk', $id_ppk)->where('jenis', $jenis)->update([
                "petugas"=>$request->petugas,
                "nilai"=>$nilaibaru,
                "id_ppk"=> $id_ppk,"jenis"=>$jenis, "petugas"=>$request->petugas,
                'a1x1', 'a1x2', 'a1x3', 'a1x4', 'a1x5', 'a1x6', 'a1x7', 'a1x8', 'a1x9', 'a1x10', 'a1x11', 'a1x12', 'a1x13', 'a1x14', 'a1x15', 'a1x16', 'a1x17', 'a1x18', 'a1x19', 'a1x20', 'a1x21', 'a1x22', 'a1x23', 'a1x24',
                'a2x1', 'a2x2', 'a2x3', 'a2x4', 'a2x5', 'a2x6', 'a2x7', 'a2x8', 'a2x9', 'a2x10', 'a2x11', 'a2x12', 'a2x13', 'a2x14', 'a2x15', 'a2x16', 'a2x17', 'a2x18', 'a2x19', 'a2x20', 'a2x21', 'a2x22', 'a2x23', 'a2x24',
                'a3x1', 'a3x2', 'a3x3', 'a3x4', 'a3x5', 'a3x6', 'a3x7', 'a3x8', 'a3x9', 'a3x10', 'a3x11', 'a3x12', 'a3x13', 'a3x14', 'a3x15', 'a3x16', 'a3x17', 'a3x18', 'a3x19', 'a3x20', 'a3x21', 'a3x22', 'a3x23', 'a3x24',
                'a4x1', 'a4x2', 'a4x3', 'a4x4', 'a4x5', 'a4x6', 'a4x7', 'a4x8', 'a4x9', 'a4x10', 'a4x11', 'a4x12', 'a4x13', 'a4x14', 'a4x15', 'a4x16', 'a4x17', 'a4x18', 'a4x19', 'a4x20', 'a4x21', 'a4x22', 'a4x23', 'a4x24',
                'a5x1', 'a5x2', 'a5x3', 'a5x4', 'a5x5', 'a5x6', 'a5x7', 'a5x8', 'a5x9', 'a5x10', 'a5x11', 'a5x12', 'a5x13', 'a5x14', 'a5x15', 'a5x16', 'a5x17', 'a5x18', 'a5x19', 'a5x20', 'a5x21', 'a5x22', 'a5x23', 'a5x24',
                'a6x1', 'a6x2', 'a6x3', 'a6x4', 'a6x5', 'a6x6', 'a6x7', 'a6x8', 'a6x9', 'a6x10', 'a6x11', 'a6x12', 'a6x13', 'a6x14', 'a6x15', 'a6x16', 'a6x17', 'a6x18', 'a6x19', 'a6x20', 'a6x21', 'a6x22', 'a6x23', 'a6x24',
                'a7x1', 'a7x2', 'a7x3', 'a7x4', 'a7x5', 'a7x6', 'a7x7', 'a7x8', 'a7x9', 'a7x10', 'a7x11', 'a7x12', 'a7x13', 'a7x14', 'a7x15', 'a7x16', 'a7x17', 'a7x18', 'a7x19', 'a7x20', 'a7x21', 'a7x22', 'a7x23', 'a7x24',
                'a8x1', 'a8x2', 'a8x3', 'a8x4', 'a8x5', 'a8x6', 'a8x7', 'a8x8', 'a8x9', 'a8x10', 'a8x11', 'a8x12', 'a8x13', 'a8x14', 'a8x15', 'a8x16', 'a8x17', 'a8x18', 'a8x19', 'a8x20', 'a8x21', 'a8x22', 'a8x23', 'a8x24',
                'a9x1', 'a9x2', 'a9x3', 'a9x4', 'a9x5', 'a9x6', 'a9x7', 'a9x8', 'a9x9', 'a9x10', 'a9x11', 'a9x12', 'a9x13', 'a9x14', 'a9x15', 'a9x16', 'a9x17', 'a9x18', 'a9x19', 'a9x20', 'a9x21', 'a9x22', 'a9x23', 'a9x24',
                'a10x1', 'a10x2', 'a10x3', 'a10x4', 'a10x5', 'a10x6', 'a10x7', 'a10x8', 'a10x9', 'a10x10', 'a10x11', 'a10x12', 'a10x13', 'a10x14', 'a10x15', 'a10x16', 'a10x17', 'a10x18', 'a10x19', 'a10x20', 'a10x21', 'a10x22', 'a10x23', 'a10x24',
                'a11x1', 'a11x2', 'a11x3', 'a11x4', 'a11x5', 'a11x6', 'a11x7', 'a11x8', 'a11x9', 'a11x10', 'a11x11', 'a11x12', 'a11x13', 'a11x14', 'a11x15', 'a11x16', 'a11x17', 'a11x18', 'a11x19', 'a11x20', 'a11x21', 'a11x22', 'a11x23', 'a11x24',
                'a12x1', 'a12x2', 'a12x3', 'a12x4', 'a12x5', 'a12x6', 'a12x7', 'a12x8', 'a12x9', 'a12x10', 'a12x11', 'a12x12', 'a12x13', 'a12x14', 'a12x15', 'a12x16', 'a12x17', 'a12x18', 'a12x19', 'a12x20', 'a12x21', 'a12x22', 'a12x23', 'a12x24',
                'a13x1', 'a13x2', 'a13x3', 'a13x4', 'a13x5', 'a13x6', 'a13x7', 'a13x8', 'a13x9', 'a13x10', 'a13x11', 'a13x12', 'a13x13', 'a13x14', 'a13x15', 'a13x16', 'a13x17', 'a13x18', 'a13x19', 'a13x20', 'a13x21', 'a13x22', 'a13x23', 'a13x24',
                'a14x1', 'a14x2', 'a14x3', 'a14x4', 'a14x5', 'a14x6', 'a14x7', 'a14x8', 'a14x9', 'a14x10', 'a14x11', 'a14x12', 'a14x13', 'a14x14', 'a14x15', 'a14x16', 'a14x17', 'a14x18', 'a14x19', 'a14x20', 'a14x21', 'a14x22', 'a14x23', 'a14x24',
                'a15x1', 'a15x2', 'a15x3', 'a15x4', 'a15x5', 'a15x6', 'a15x7', 'a15x8', 'a15x9', 'a15x10', 'a15x11', 'a15x12', 'a15x13', 'a15x14', 'a15x15', 'a15x16', 'a15x17', 'a15x18', 'a15x19', 'a15x20', 'a15x21', 'a15x22', 'a15x23', 'a15x24',
                'a16x1', 'a16x2', 'a16x3', 'a16x4', 'a16x5', 'a16x6', 'a16x7', 'a16x8', 'a16x9', 'a16x10', 'a16x11', 'a16x12', 'a16x13', 'a16x14', 'a16x15', 'a16x16', 'a16x17', 'a16x18', 'a16x19', 'a16x20', 'a16x21', 'a16x22', 'a16x23', 'a16x24',
                'a17x1', 'a17x2', 'a17x3', 'a17x4', 'a17x5', 'a17x6', 'a17x7', 'a17x8', 'a17x9', 'a17x10', 'a17x11', 'a17x12', 'a17x13', 'a17x14', 'a17x15', 'a17x16', 'a17x17', 'a17x18', 'a17x19', 'a17x20', 'a17x21', 'a17x22', 'a17x23', 'a17x24',
                'a18x1', 'a18x2', 'a18x3', 'a18x4', 'a18x5', 'a18x6', 'a18x7', 'a18x8', 'a18x9', 'a18x10', 'a18x11', 'a18x12', 'a18x13', 'a18x14', 'a18x15', 'a18x16', 'a18x17', 'a18x18', 'a18x19', 'a18x20', 'a18x21', 'a18x22', 'a18x23', 'a18x24',
                'a19x1', 'a19x2', 'a19x3', 'a19x4', 'a19x5', 'a19x6', 'a19x7', 'a19x8', 'a19x9', 'a19x10', 'a19x11', 'a19x12', 'a19x13', 'a19x14', 'a19x15', 'a19x16', 'a19x17', 'a19x18', 'a19x19', 'a19x20', 'a19x21', 'a19x22', 'a19x23', 'a19x24',
                'a20x1', 'a20x2', 'a20x3', 'a20x4', 'a20x5', 'a20x6', 'a20x7', 'a20x8', 'a20x9', 'a20x10', 'a20x11', 'a20x12', 'a20x13', 'a20x14', 'a20x15', 'a20x16', 'a20x17', 'a20x18', 'a20x19', 'a20x20', 'a20x21', 'a20x22', 'a20x23', 'a20x24',
                'a21x1', 'a21x2', 'a21x3', 'a21x4', 'a21x5', 'a21x6', 'a21x7', 'a21x8', 'a21x9', 'a21x10', 'a21x11', 'a21x12', 'a21x13', 'a21x14', 'a21x15', 'a21x16', 'a21x17', 'a21x18', 'a21x19', 'a21x20', 'a21x21', 'a21x22', 'a21x23', 'a21x24',
                'a22x1', 'a22x2', 'a22x3', 'a22x4', 'a22x5', 'a22x6', 'a22x7', 'a22x8', 'a22x9', 'a22x10', 'a22x11', 'a22x12', 'a22x13', 'a22x14', 'a22x15', 'a22x16', 'a22x17', 'a22x18', 'a22x19', 'a22x20', 'a22x21', 'a22x22', 'a22x23', 'a22x24',
                'a23x1', 'a23x2', 'a23x3', 'a23x4', 'a23x5', 'a23x6', 'a23x7', 'a23x8', 'a23x9', 'a23x10', 'a23x11', 'a23x12', 'a23x13', 'a23x14', 'a23x15', 'a23x16', 'a23x17', 'a23x18', 'a23x19', 'a23x20', 'a23x21', 'a23x22', 'a23x23', 'a23x24',
                'a24x1', 'a24x2', 'a24x3', 'a24x4', 'a24x5', 'a24x6', 'a24x7', 'a24x8', 'a24x9', 'a24x10', 'a24x11', 'a24x12', 'a24x13', 'a24x14', 'a24x15', 'a24x16', 'a24x17', 'a24x18', 'a24x19', 'a24x20', 'a24x21', 'a24x22', 'a24x23', 'a24x24',
                'a25x1', 'a25x2', 'a25x3', 'a25x4', 'a25x5', 'a25x6', 'a25x7', 'a25x8', 'a25x9', 'a25x10', 'a25x11', 'a25x12', 'a25x13', 'a25x14', 'a25x15', 'a25x16', 'a25x17', 'a25x18', 'a25x19', 'a25x20', 'a25x21', 'a25x22', 'a25x23', 'a25x24',
                'a26x1', 'a26x2', 'a26x3', 'a26x4', 'a26x5', 'a26x6', 'a26x7', 'a26x8', 'a26x9', 'a26x10', 'a26x11', 'a26x12', 'a26x13', 'a26x14', 'a26x15', 'a26x16', 'a26x17', 'a26x18', 'a26x19', 'a26x20', 'a26x21', 'a26x22', 'a26x23', 'a26x24',
                'a27x1', 'a27x2', 'a27x3', 'a27x4', 'a27x5', 'a27x6', 'a27x7', 'a27x8', 'a27x9', 'a27x10', 'a27x11', 'a27x12', 'a27x13', 'a27x14', 'a27x15', 'a27x16', 'a27x17', 'a27x18', 'a27x19', 'a27x20', 'a27x21', 'a27x22', 'a27x23', 'a27x24',
                'a28x1', 'a28x2', 'a28x3', 'a28x4', 'a28x5', 'a28x6', 'a28x7', 'a28x8', 'a28x9', 'a28x10', 'a28x11', 'a28x12', 'a28x13', 'a28x14', 'a28x15', 'a28x16', 'a28x17', 'a28x18', 'a28x19', 'a28x20', 'a28x21', 'a28x22', 'a28x23', 'a28x24',
                'a29x1', 'a29x2', 'a29x3', 'a29x4', 'a29x5', 'a29x6', 'a29x7', 'a29x8', 'a29x9', 'a29x10', 'a29x11', 'a29x12', 'a29x13', 'a29x14', 'a29x15', 'a29x16', 'a29x17', 'a29x18', 'a29x19', 'a29x20', 'a29x21', 'a29x22', 'a29x23', 'a29x24',
                'a30x1', 'a30x2', 'a30x3', 'a30x4', 'a30x5', 'a30x6', 'a30x7', 'a30x8', 'a30x9', 'a30x10', 'a30x11', 'a30x12', 'a30x13', 'a30x14', 'a30x15', 'a30x16', 'a30x17', 'a30x18', 'a30x19', 'a30x20', 'a30x21', 'a30x22', 'a30x23', 'a30x24',
                 ]);
        }
        else{
            organoleptik::insert([
                "id_ppk"=> $id_ppk,"jenis"=>$jenis, "petugas"=>$request->petugas,
                "nilai"=>$nilaibaru
            ]);
        }
        return redirect('/admin/organoleptik/'.$id_ppk.'/'.$jenis)->with('berhasilSimpan','Data berhasil disimpan');
    }

}
