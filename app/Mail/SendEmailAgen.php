<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailAgen extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $token;
    public $trigger;

    public function __construct($name, $email, $token, $trigger)
    {
        $this->nama_lengkap = $name;
        $this->email = $email;
        $this->token = $token;
        $this->trigger = $trigger;
    }

    public function build()
    {
        if($this->trigger == "email_verify"){
            return $this->subject('Verifikasi Akun')
                ->from('ashiaaap2018@gmail.com')
                ->view('agen.email.verifikasi-email')
                ->with([
                    'nama_lengkap' => $this->name
                ]);
        }else if($this->trigger == "forgot_password"){
            return $this->subject('Ganti kata sandi')
                ->from('ashiaaap2018@gmail.com')
                ->view('agen.email.ganti-password')
                ->with([
                    'nama_lengkap' => $this->name
            ]);
        }
    }
}
