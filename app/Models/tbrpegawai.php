<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbrpegawai extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table ="tb_r_pegawai";
    protected $primaryKey='nip';
    public $timestamps = false;
    protected $fillable = [
        'nip_baru',
        'nip',
        'nama',
        'alamat',
        'id_jabatan',
        'id_jenjang',
        'kd_gol',
        'kd_upt',
        'keterangan',
        'st_pegawai',
        'pangkat_tmt',
        'periode_ak_tmt',
        'awal_ak',
        'tplhr',
        'tglhr',
        'tgl_berlaku',
        'status',
        'sts_sync',
        'email',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
