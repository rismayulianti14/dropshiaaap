<?php

namespace App\Http\Controllers\Reseller\Auth;
use App\Models\Agen\ForgotPassword;
use App\Models\Reseller\Reseller;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('reseller.auth.forgot-password');
    }

    public function store(Request $request)
    {
        $email = $request->email;
        $reseller = Reseller::where('email', $email)->first();
        //dd($reseller);

        if($reseller != null){

            $now = date('Y-m-d H:i:s');

            $fp = new ForgotPassword;
            $fp->token = md5($now);
            $fp->user_id = $reseller->id;
            $fp->status = '0';

            $name = $reseller->nama_lengkap;
            $token = md5($now);
            $trigger = "forgot_password";

            Mail::to($email)->send(new SendEmailReseller($name, $email, $token, $trigger));

            $fp->save();

            return redirect()->route('reseller.login')->with(['success' => 'Permintaan ganti password berhasil dikirim']);
        }else{
            return redirect()->route('reseller.lupa-sandi')->with(['failed' => 'Email tidak ditemukan']);
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

        return view('reseller.auth.ubah-password', compact('alert','user_id', 'token'));
    }

    public function post_ubah_password(Request $request,$token, $id)
    {
        $reseller = Reseller::find($id);
        $reseller->password = md5($request->password);
        $reseller->save();
        //dd($reseller);

        $fp = ForgotPassword::where('token', $request->token)->first();

        $fp->status = 1;
        $fp->save();

        return redirect()->route('reseller.login')->with(['success' => 'Kata sandi berhasil diubah']);
    }
}
