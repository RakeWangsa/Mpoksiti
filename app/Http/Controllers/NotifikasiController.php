<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasi;
use Illuminate\Support\Facades\DB;
use App\Models\vDataHeader;
use App\Models\Ppk;
use App\Models\Trader;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use App\Models\MasterSubform;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Subform;
use App\Models\ImageStuffing;
use App\Models\activity_log;

class NotifikasiController extends Controller
{
    public function index()
    {
        $now = now();
        $skrg = $now->format('Y-m-d');
        $tgl_trak = date('Y-m-d', strtotime($skrg. ' - 25 days'));
        $trader = array();
        foreach (Trader::all() as $item) {
            $trader[$item->id_trader] = $item->nm_trader;
        }
        $master = array();
        foreach (MasterSubform::all() as $item) {
            $master[$item->id_masterSubform] = $item->indikator;
        }
        $tipe_data = array();
        foreach (MasterSubform::all() as $item) {
            $tipe_data[$item->id_masterSubform] = $item->tipe_data;
        }
        $ppks = new PpkController();
        $ppkModel = new Ppk();
        $dbView = DB::connection('sqlsrv')->getDatabaseName().'.dbo';
        $dbView2 = DB::connection('sqlsrv2')->getDatabaseName() . '.dbo';
        $ppks = DB::connection('sqlsrv2')->table('v_data_header')
        ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', 'ppks.id_ppk')
        ->where('v_data_header.kd_kegiatan', 'E')
        ->whereDate('tgl_ppk', '>', $tgl_trak)
        ->whereNotNull('ppks.status')
        ->select('ppks.*', 'v_data_header.*')
        ->orderBy('ppks.id', 'DESC')
        ->get();
        foreach ($ppks as $data) {
            $data->subform = Subform::rightJoin("ppks as ppks", "subform.id_ppk", "ppks.id_ppk")
                ->select("ppks.*", "subform.*")
                ->where("subform.id_ppk", $data->id_ppk)
                ->get();
        }
        foreach ($ppks as $image) {
            $image->stuffing = ImageStuffing::rightJoin("$dbView2.v_data_header as v_data_header", "images_stuffing.id_ppk", "v_data_header.id_ppk")
                ->select('v_data_header.*', 'images_stuffing.*')
                ->where("images_stuffing.id_ppk", $image->id_ppk)
                ->get();
        }

        $pegawai = DB::connection('sqlsrv2')->table('tb_r_pegawai')
            ->select('nama', 'email')
            ->get();

        $kirim =  $ppks->where('id_ppk', session('notif_noppk'))->first();
        $petugas = $pegawai->where('nama', session('petugas'))->first();

        Mail::to($petugas->email)->send(new notifikasi($kirim));
        return redirect('/admin/stuffing')->with('success', 'Berhasil mengirim notifikasi ke petugas!');
    }
}
