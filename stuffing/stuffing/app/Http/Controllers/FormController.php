<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trader;
use App\Models\Ppk;
use App\Models\KategoriDokumen;
use App\Models\MasterDokumen;
use App\Models\Dokumen;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\vDataHeader;
use App\Models\Subform;
use App\Models\MasterSubform;
use Exception;
use Symfony\Component\Console\Input\Input;

class FormController extends Controller
{
    public function index(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        return view('admin.form_stuffing', [
            "title" => 'Form Hasil Stuffing',
            "data" => $join,
            "ppk" => $id_ppk,
        ]);
    }

    public function storeSubform(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        try {
            $input = $this->getDataInput($request, $id_ppk) ?? [];
        } catch (Exception $e) {
            return redirect()->back()->with('Error', $e->getMessage())->withInput();
        }
        if (!empty($input)) {
            DB::beginTransaction();
            foreach ($input as $i) {
                Subform::where('id_subform', $i['idsubform'])->update([
                    'value'=>$i['value'],
                    'keterangan'=>$i['keterangan']
                ]);
                if($i['tipe_data'] == 'rekomendasi'){
                    if($i['value'] == 'Sesuai'){
                        Ppk::where('id_ppk', $id_ppk)->update([
                            "status" => "Persetujuan",
                        ]);
                    }else{
                        Ppk::where('id_ppk', $id_ppk)->update([
                            "status" => "Ditolak",
                        ]);
                    }
                }
            }
            if($request->hasFile('images_stuffing'))
            {
                foreach($request->file('images_stuffing') as $key => $file)
                {
                    $path = $file->store('public/images_stuffing');
                    $name = $file->getClientOriginalName();
                    $insert[$key]['images'] = $name;
                    $insert[$key]['id_ppk'] = $id_ppk;
                    $file->move(public_path().'/images_stuffing', $name);  
                }
                DB::table('images_stuffing')->insert($insert);
            }
            DB::commit();
            return redirect('/admin/stuffing')->with('Success', 'Form telah diisi!!!!!!!!!!!');
        }
    }

    private function getDataInput(Request $request, $id_ppk)
    {
        $join = Subform::join('master_subform', 'subform.id_masterSubform', '=', 'master_subform.id_masterSubform')->where('subform.id_ppk', $id_ppk)
            ->get(['master_subform.id_masterSubform', 'master_subform.indikator', 'master_subform.tipe_data', 'subform.id_subform']);
        $input = array();
        foreach ($join as $j) {
            $data['value'] = $request->input("input-$j->id_masterSubform-$j->id_subform");
            $data['keterangan'] = $request->input("keterangan-$j->id_masterSubform-$j->id_subform", null);
            $data['idsubform'] = $j->id_subform;
            $data['tipe_data'] = $j->tipe_data;

            if ($j->tipe_data == 'kondisi') {
                if ($data['value'] == 'Tidak Sesuai') {
                    if (!isset($data['keterangan'])) {
                        throw new Exception('Semua Indikator harus diisi');
                        break;
                    }
                }
            }
            else if ($j->tipe_data == 'rekomendasi') {
                if (!isset($data['keterangan'])) {
                    throw new Exception('Semua Indikator harus diisi');
                    break;
                }
            } else {
                if (!isset($data['value'])) {
                    throw new Exception('Semua Indikator harus diisi');
                    break;
                }
            }
            $input[] = $data;
        }
        return $input;
    }
    // select leftjoin master m (select urutan id_master from subform where id_ppk = id_ppk) s on m.id_master = s.id_master

    public function Hasil($id_ppk){
        $master = array();
        foreach (MasterSubform::all() as $item) {
            $master[$item->id_masterSubform] = $item->indikator;
        }
        return view('trader.hasil_form', [
            "title"=>'Hasil Stuffing Virtual',
            "form"=>Subform::where('id_ppk', $id_ppk)->get(),
            "master"=>$master,
        ]);
    }
}
