<?php
     
namespace App\Http\Traits;
 
use App\Models\Setting;
 
trait GlobalTrait {
 
    public function getAllSettings() 
    {
        // Fetch all the settings from the 'settings' table.
        $settings = Setting::all();
        return $settings;
    }
}