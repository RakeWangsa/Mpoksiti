<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activity_log_traders extends Model
{
    use HasFactory;
    protected $table = "activity_log_traders";
    protected $fillable = [
        'id', 'created_at','description', 'ip', 'lokasi',
    ];
}
