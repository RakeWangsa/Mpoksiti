<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class organoleptik extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv2';
    protected $table = "organoleptik";
    public $timestamps = false;
    protected $fillable = [
        'id_ppk', 
        'A91', 'A92', 'A93', 'A94', 'A95', 'A96', 'A97', 'A98', 'A99', 'A910', 'A911', 'A912', 'A913', 'A914', 'A915', 'A916', 'A917', 'A918', 'A919', 'A920', 'A921', 'A922', 'A923', 'A924'
    ];
}
