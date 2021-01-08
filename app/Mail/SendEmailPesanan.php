<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailPesanan extends Mailable
{
    use Queueable, SerializesModels;

    public $nama_lengkap;
    public $email;
    public $no_pesanan;
    public $total;
    public $trigger;

    public function __construct($nama_lengkap, $email, $no_pesanan, $total, $trigger)
    {
        $this->nama_lengkap = $nama_lengkap;
        $this->email = $email;
        $this->no_pesanan = $no_pesanan;
        $this->total = $total;
        $this->trigger = $trigger;
    }

    public function build()
    {
        if($this->trigger == "pesanan_dikonfirmasi"){
            return $this->subject('Pesanan dikemas')
                ->from('ashiaaap2018@gmail.com')
                ->view('agen.email.pesanan')
                ->with([
                    'nama_lengkap' => $this->nama_lengkap,
                    'no_pesanan' => $this->nama_lengkap
                ]);
        }else if($this->trigger == "pesanan_belum_dibayar"){
            return $this->subject('Segera lakukan pembayaran')
                ->from('ashiaaap2018@gmail.com')
                ->view('pusat.order.belum bayar.email')
                ->with([
                    'nama_lengkap' => $this->nama_lengkap,
                    'no_pesanan' => $this->nama_lengkap,
                    'total' => $this->total
                ]);
        }
    }
}
