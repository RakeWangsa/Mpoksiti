<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_log extends Model
{
    use HasFactory;
    protected $table = "activity_log";
    protected $fillable = [
        'id', 'log_name', 'created_at','description', 'ip', 'lokasi',
    ];
}
