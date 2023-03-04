<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class notifikasi extends Mailable
{
    use Queueable, SerializesModels;

    public $kirim;

    public function __construct($kirim)
    {
        $this->kirim = $kirim;
    }

    public function build()
    {
        return $this->view('email')
                    ->with(['kirim' => $this->kirim]);
    }
}
