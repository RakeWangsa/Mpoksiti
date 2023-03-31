<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use App\Models\MasterSubform;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\vDataHeader;
use App\Models\Subform;
use App\Models\ImageStuffing;
use App\Models\activity_log;
use Illuminate\Support\Facades\Mail;
use App\Mail\notifikasi;
use App\Models\tbrpegawai;
use Illuminate\Validation\Rule;

class StuffingController extends Controller
{
    public function index(Request $request)
    {
        if (session()->has('batas')) {
            if(isset($request->batas)){
                session()->put('batas', $request->batas);
            }
        } else {
            session()->put('batas','5');
        }
        $batas = session()->get('batas');
        $now = now();
        $skrg = $now->format('Y-m-d');
        $tgl_trak = date('Y-m-d', strtotime($skrg. ' - ' .$batas .'days'));
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
        // $vdataHeader = new vDataHeader();
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
        // $pegawai = DB::table('tb_r_pegawai')
        //     ->select('nama','email')
        //     ->get();
        $pegawai = DB::connection('sqlsrv2')->table('tb_r_pegawai')
            ->select('nama', 'email')
            ->get();
            
        return view('admin.stuffing', [
            "title" => "Stuffing",
            // "ppks" => $ppkModel->where("id_trader", Auth::user()->id_trader)->get(),
            "ppks" => $ppks,
            "trader" => $trader,
            "master" => $master,
            "tipe"=> $tipe_data,
            "pegawai"=> $pegawai,
            "batas"=> $batas
        ]);
    }

    public function dokumen($id_ppk)
    {
        $ppks = new PpkController();
        $ppk = $ppks->getIf($id_ppk)[0];
        $dokumens = new Dokumen();
        $kategoriModel = new KategoriDokumen();
        // $dokumen = $dokumens->getIf($id_dokumen)[0];
        // $kategoriJoinDokumen = KategoriDokumen::leftJoin('dokumens','kategori_dokumens.id_kategori','=','dokumens.id_kategori')
        // ->where('kategori_dokumens.status', 1)
        // ->get(['dokumens.nm_dokumen','kategori_dokumens.id_kategori', 'kategori_dokumens.nama_dokumen', 'dokumens.no_dokumen']);
        // $filter = $this->filterDocumentByIdPPK($kategoriJoinDokumen, $id_ppk);
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        $masterDokumenModel = new MasterDokumen();

        $nilai = DB::connection('sqlsrv2')->table('kepatuhan')
            ->where('id_ppk',$id_ppk)
            ->pluck('nilai')
            ->first();

        return view('admin.document_stuffing', [
            "title" => "Unggah Dokumen",
            "ppk" => $ppk,
            "kategoris" => $kategoriModel->where('status', 1)->get(),
            "dokumens" => $this->getDetailDokumen($id_ppk),
            "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
            "kategoriMaster" => $kategori,
            "masterDokumens" => $this->getMasterDokumen(),
            "id_ppk" => $id_ppk,
            "nilai" => $nilai
            // "delDokumen"=> $dokumens
        ]);
        // echo json_encode( [
        //     "title" => "Unggah Dokumen",
        //     "ppk" => $ppk,
        //     "kategoris" => $kategoriModel->all(),
        //     "dokumens" => $this->getNamaDokumen($id_ppk),
        //     "masters" => $masterDokumenModel->where("id_trader", Auth::user()->id_trader)->get(),
        //     "kategoriMaster" => $kategori,
        //     "masterDokumens" => $this->getMasterDokumen(),
        //     // "delDokumen"=> $dokumens
        // ]);
    }

    // Tidak dipakai karena yg dipakai get detail dokumen 
    // private function getNamaDokumen($id_ppk)
    // {
    //     $dokumens = new Dokumen();
    //     $list_dokumen = $dokumens->where('id_ppk', $id_ppk)->get();
    //     $result = array();
    //     foreach ($list_dokumen as $dokumen) {
    //         $result[$dokumen['id_kategori']] = array('id_master' => $dokumen['id_master']);
    //         $result[$dokumen['id_kategori']] += array('id_dokumen' => $dokumen['id_dokumen']);
    //     }
    //     return $result;
    // }

    private function getDetailDokumen($id_ppk)
    {
        $dokumens = new Dokumen();
        $list_dokumen = $dokumens->where('id_ppk', $id_ppk)
            ->join('master_dokumens', 'dokumens.id_master', '=', 'master_dokumens.id_master')
            ->get();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array('nm_dokumen' => $dokumen['nm_dokumen']);
            $result[$dokumen['id_kategori']] += array('no_dokumen' => $dokumen['no_dokumen']);
            $result[$dokumen['id_kategori']] += array('tgl_terbit' => $dokumen['tgl_terbit']);
            $result[$dokumen['id_kategori']] += array('id_dokumen' => $dokumen['id_dokumen']);
        }
        return $result;
    }


    private function getMasterDokumen()
    {
        $dokumens = new MasterDokumen();
        $list_dokumen = $dokumens
            ->where('status', 'Aktif')
            ->where('tipe_dokumen', 1)->get();
        $result = array();
        foreach ($list_dokumen as $dokumen) {
            $result[$dokumen['id_kategori']] = array();
        }
        foreach ($list_dokumen as $dokumen) {
            array_push($result[$dokumen['id_kategori']], [
                'id_master' => $dokumen['id_master'],
                'nm_dokumen' => $dokumen['nm_dokumen'],
                'no_dokumen' => $dokumen['no_dokumen'],
                'tgl_terbit' => $dokumen['tgl_terbit'],
                'status' => $dokumen['status'],
            ]);
        }
        return $result;
    }

    // Untuk Terima dan Tolak Dokumen
    public function accept($id_ppk)
    {
        // $id_master = $request->input('id_master');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Penjadwalan",
            "deskripsi" => null
        ]);
        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        activity_log::insert([
            'description' => 'admin menyetujui verifikasi dokumen dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);


        return redirect('/admin/stuffing')->with('success', 'Dokumen telah disetujui!');
    }
     // Untuk Terima dan Tolak Dokumen
    public function onsite($id_ppk)
    {
        // $id_master = $request->input('id_master');
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Onsite Stuffing",
            "deskripsi" => null
        ]);


        return redirect('/admin/stuffing')->with('success', 'Onsite Stuffing!');
    }

    public function decline(Request $request, $id_ppk)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            "deskripsi" => 'required',
        ], $messages);

        // $id_master = $request->input('id_master');
        Ppk::where('id_ppk', $id_ppk)->update([
           // "status" => "Gagal",
              "status" => "Revisi",
            
            "deskripsi" => $request->deskripsi
        ]);

        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
        activity_log::insert([
            'description' => 'admin menolak verifikasi dokumen dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);


        return redirect('/admin/stuffing')->with('error', 'Dokumen tidak disetujui!');
    }

    // Untuk Terima dan Tolak Jadwal
    public function terima(Request $request, $id_ppk)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'url_periksa.required' => 'Link meeting wajib diisi ',
            'petugas.required'=> 'Petugas wajib diisi!!',
            'petugas.not_in' => 'Petugas wajib diisi!!',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            "url_periksa" => 'required',
            "petugas" => ['required', Rule::notIn(['Pilih Petugas'])]
        ], $messages);

        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Stuffing",
            "deskripsi" => null,
            "url_periksa"=> $request->url_periksa
        ]);

        // Validasi jangan lupa
        // Select dari table subform where id ppk = id ppk
        // if number of row lebih dari 0, empty
        // else select(*) from master, nanti dapet id_masternya terus pake
        // 
        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        activity_log::insert([
            'description' => 'admin menerima pengajuan jadwal dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);

        $count = Subform::where('id_ppk', $id_ppk)->count();
        if($count == 0){
            $master = MasterSubform::all();
            DB::beginTransaction();
            foreach($master as $key=>$m){
                Subform::insert([
                    'urutan'=>++$key,
                    'value'=>'',
                    'visibility'=>'show',
                    'id_masterSubform'=>$m->id_masterSubform,
                    'id_ppk'=>$id_ppk,
                ]);
            }
            DB::commit();

        }
        session([
            'notif_noppk' => $id_ppk,
            'petugas' => $request->petugas
        ]);
        return redirect('/notifikasi');
        //return redirect('/admin/stuffing')->with('success', 'Jadwal telah disetujui!');
    }
    public function revisi(Request $request, $id_ppk)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'url_periksa.required' => 'Link meeting wajib diisi ',
            'jadwal_periksa.required'=> 'Jadwal wajib diisi!!',
            'petugas.required'=> 'Petugas wajib diisi!!',
            'petugas.not_in' => 'Petugas wajib diisi!!',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        

        $this->validate($request, [
            "url_periksa" => 'required',
            "jadwal_periksa" => 'required',
            "petugas" => ['required', Rule::notIn(['Pilih Petugas'])]
        ], $messages);

        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Stuffing",
            "deskripsi" => null,
            "url_periksa"=> $request->url_periksa,
            "jadwal_periksa"=> date('Y-m-d H:i', strtotime($request->jadwal_periksa))
        ]);

        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        activity_log::insert([
            'description' => 'admin merevisi jadwal dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);

        // Validasi jangan lupa
        // Select dari table subform where id ppk = id ppk
        // if number of row lebih dari 0, empty
        // else select(*) from master, nanti dapet id_masternya terus pake
        // 
        $count = Subform::where('id_ppk', $id_ppk)->count();
        if($count == 0){
            $master = MasterSubform::all();
            DB::beginTransaction();
            foreach($master as $key=>$m){
                Subform::insert([
                    'urutan'=>++$key,
                    'value'=>'',
                    'visibility'=>'show',
                    'id_masterSubform'=>$m->id_masterSubform,
                    'id_ppk'=>$id_ppk,
                ]);
            }
            DB::commit();

        }
        session([
            'notif_noppk' => $id_ppk,
            'petugas' => $request->petugas
        ]);
        return redirect('/notifikasi');
        // Mail::to('rakekw28@gmail.com')->send(new notifikasi);
        // return redirect('/admin/stuffing')->with('success', 'Jadwal telah direvisi!');
    }
    public function tolak(Request $request, $id_ppk)
    {

        $messages = [
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            "deskripsi" => 'required',
        ], $messages);

        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Ditolak",
            "deskripsi" => $request->deskripsi,
            "url_periksa"=> null,
        ]);

        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        activity_log::insert([
            'description' => 'admin menolak pengajuan jadwal dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);


        return redirect('/admin/stuffing')->with('error', 'Jadwal tidak disetujui!');
    }

    public function izin(Request $request, $id_ppk)
    {
        $messages = [
            'required' => ':attribute wajib diisi ',
            'no_izin.required' => 'Nomor izin wajib diisi ',
            'tgl_izin.required' => 'Tanggal izin wajib diisi ',
            'required' => ':attribute wajib diisi ',
            'min' => ':attribute harus diisi minimal :min karakter !!!',
            'max' => ':attribute harus diisi maksimal :max karakter !!!',
            'numeric' => ':attribute harus diisi angka !!!',
            'email' => ':attribute harus diisi dalam bentuk email !!!',
        ];

        $this->validate($request, [
            "no_izin" => 'required',
            "tgl_izin" => 'required',
        ], $messages);
        
        Ppk::where('id_ppk', $id_ppk)->update([
            "status" => "Cetak HC",
            "no_izin" => $request->no_izin,
            "tgl_izin"=> date('Y-m-d H:i', strtotime($request->tgl_izin)),
        ]);

        $checkLocation=geoip()->getLocation($_SERVER['REMOTE_ADDR']);
        $mytime = Carbon::now();
        $email = session()->get('email');
        //activity()->causedBy(Auth::user())->log('admin melakukan login | ip : '.$checkLocation->ip.' | location : '.$checkLocation->city);
        activity_log::insert([
            'description' => 'admin menyetujui trader dengan id ppk : '.$id_ppk,
            'created_at' => $mytime,
            'ip' => $checkLocation->ip,
            'lokasi' => $checkLocation->city,
            'email' => $email
        ]);

        return redirect('/admin/stuffing')->with('success', "PPK $id_ppk telah disetujui!");
    }

    public function detail(Request $request, $id_ppk)
    {
        $dbView = DB::connection('sqlsrv')->getDatabaseName() . '.dbo';
        $viewPpk = DB::connection('sqlsrv2')->table('v_data_header')
            ->leftJoin("$dbView.ppks AS ppks", 'v_data_header.id_ppk', '=', "ppks.id_ppk")
            ->leftJoin("$dbView.subform as subform", 'v_data_header.id_ppk', '=', "subform.id_ppk")
            ->where("v_data_header.id_ppk", $id_ppk)
            ->select('ppks.*', 'v_data_header.*', 'subform.*')->get();
        $detailPpk = DB::connection('sqlsrv2')->table('v_data_header')->where("v_data_header.id_ppk", $id_ppk)->get();
        $detailStuf = DB::table('Ppks')->where("Ppks.id_ppk", $id_ppk)->get();
        $dokumen = DB::table('dokumens')
        ->leftJoin('master_dokumens as master', 'dokumens.id_master', 'master.id_master')
        ->where('dokumens.id_ppk', $id_ppk)
        ->select('dokumens.*', 'master.*')->get();
        $kategori = array();
        foreach (KategoriDokumen::all() as $item) {
            $kategori[$item->id_kategori] = $item->nama_kategori;
        }
        return view('admin.detail', [
            "title"=> "Detail Stuffing",
            "details"=>$detailPpk,
            "stuffing"=>$detailStuf,
            "dokumen"=>$dokumen,
            "kategori"=>$kategori,
        ]);
    }
}
