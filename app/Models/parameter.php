<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class parameter extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = "parameter";
    public $timestamps = false;
    protected $fillable = [
        'jenis',
        'parameter1', 'parameter2', 'parameter3', 'parameter4', 'parameter5', 'parameter6', 'parameter7', 'parameter8', 'parameter9', 'parameter10',
        'parameter11', 'parameter12', 'parameter13', 'parameter14', 'parameter15', 'parameter16', 'parameter17', 'parameter18', 'parameter19', 'parameter20',
        'parameter21', 'parameter22', 'parameter23', 'parameter24', 'parameter25', 'parameter26', 'parameter27', 'parameter28', 'parameter29', 'parameter30',
        'parameter31', 'parameter32', 'parameter33', 'parameter34', 'parameter35', 'parameter36', 'parameter37', 'parameter38', 'parameter39', 'parameter40',
        'parameter41', 'parameter42', 'parameter43', 'parameter44', 'parameter45', 'parameter46', 'parameter47', 'parameter48', 'parameter49', 'parameter50',
        'nilai1', 'nilai2', 'nilai3', 'nilai4', 'nilai5', 'nilai6', 'nilai7', 'nilai8', 'nilai9', 'nilai10',
        'nilai11', 'nilai12', 'nilai13', 'nilai14', 'nilai15', 'nilai16', 'nilai17', 'nilai18', 'nilai19', 'nilai20',
        'nilai21', 'nilai22', 'nilai23', 'nilai24', 'nilai25', 'nilai26', 'nilai27', 'nilai28', 'nilai29', 'nilai30',
        'nilai31', 'nilai32', 'nilai33', 'nilai34', 'nilai35', 'nilai36', 'nilai37', 'nilai38', 'nilai39', 'nilai40',
        'nilai41', 'nilai42', 'nilai43', 'nilai44', 'nilai45', 'nilai46', 'nilai47', 'nilai48', 'nilai49', 'nilai50',
    ];
}
