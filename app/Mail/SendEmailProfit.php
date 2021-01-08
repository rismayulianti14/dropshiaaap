<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailProfit extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $profit;
    public $token;
    public $trigger;

    public function __construct($name, $email, $profit, $token, $trigger)
    {
        $this->nama_lengkap = $name;
        $this->email = $email;
        $this->profit = $profit;
        $this->token = $token;
        $this->trigger = $trigger;
    }

    
    public function build()
    {
        if($this->trigger == "penarikan_profit"){
            return $this->subject('Penarikan profit')
                ->from('ashiaaap2018@gmail.com')
                ->view('pusat.email.notif-profit')
                ->with([
                    'nama_lengkap' => $this->name,
                    'profit' => $this->profit
                ]);
        }
    }
}
