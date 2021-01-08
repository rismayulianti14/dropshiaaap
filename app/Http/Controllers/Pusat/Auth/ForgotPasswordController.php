<?php

namespace App\Http\Controllers\Pusat\Auth;
use App\Models\Pusat\Petugas;
use App\Models\Pusat\ForgotPassword;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailPusat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('pusat.auth.forgot-password');
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $petugas = Petugas::where('email', $email)->first();
        //dd($petugas);

        if($petugas != null){

            $now = date('Y-m-d H:i:s');

            $fp = new ForgotPassword;
            $fp->token = md5($now);
            $fp->user_id = $petugas->id;
            $fp->status = '0';

            $name = $petugas->nama_lengkap;
            $token = md5($now);
            $trigger = "forgot_password";

            Mail::to($email)->send(new SendEmailPusat($name, $email, $token, $trigger));

            $fp->save();

            return redirect()->route('pusat.login')->with(['success' => 'Permintaan ganti password berhasil dikirim']);
        }else{
            return redirect()->route('pusat.lupa-sandi')->with(['failed' => 'Email tidak ditemukan']);
        }
    }

    public function verifikasi_ubah_password($token)
    {
        $fp = ForgotPassword::where('token', $token)->first();

        $user_id = $fp->user_id;
        $token = $token;
        if($fp->status == 0){
            $alert = 0;
        }else{
            $alert = 1;
        }

        return view('pusat.auth.ubah-password', compact('alert','user_id', 'token'));
    }

    public function post_ubah_password(Request $request,$token, $id)
    {
        $petugas = Petugas::find($id);
        $petugas->password = md5($request->password);
        $petugas->save();

        $fp = ForgotPassword::where('token', $request->token)->first();

        $fp->status = 1;
        $fp->save();

        return redirect()->route('pusat.login')->with(['success' => 'Kata sandi berhasil diubah']);
    }
}
