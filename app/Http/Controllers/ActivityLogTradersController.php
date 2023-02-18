<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\activity_log;

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

class ActivityLogTradersController extends Controller
{
    public function index(Request $request)
    {
        $dbView = DB::connection('sqlsrv')->getDatabaseName() . '.dbo';
        $logs = DB::select("SELECT * FROM $dbView.activity_log_traders");
        return view('admin.logTraders', [
            "title" => "ActivityLogTraders",
            "logs" => $logs,
        ]);
    }
}