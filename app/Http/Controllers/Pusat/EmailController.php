<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Petugas;
use App\Models\Pusat\EmailVerify;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function email_verify($token)
    {
        $verifikasi = EmailVerify::where('token', $token)->first();

        if($verifikasi != null){
            $verifikasi->status = 1;
            $verifikasi->save();

            $petugas = Petugas::where('id', $verifikasi->user_id)->first();
            $petugas->email_verify = 1;
            $petugas->save();

            return view('pusat.email.berhasil-verifikasi');
        }else{
            echo "Gagal Verifikasi";
        }
    }
}
