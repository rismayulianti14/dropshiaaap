<?php

namespace App\Http\Controllers\Agen\Auth;
use App\Models\Agen\Agen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('agen.auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:100|email',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->email;
        $password = md5($request->password);

        $agen = Agen::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 1)
                    ->first();
        
        $agen2 = Agen::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 0)
                    ->where('status', 1)
                    ->first();

        $agen3 = Agen::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 0)
                    ->first();

        if($agen){
            \Session::put('id', $agen->id);
            \Session::put('kode_id', $agen->kode_id);
            \Session::put('nama_lengkap', $agen->nama_lengkap);
            \Session::put('username', $agen->username);
            \Session::put('email', $agen->email);
            \Session::put('telepon', $agen->telepon);
            \Session::put('status', $agen->status); 
            \Session::put('image', $agen->image);
            \Session::put('password', $agen->password);

            return redirect('/agen/dashboard');
        }elseif($agen2){
            return redirect()->route('agen.login')->with(['failed' => 'Email belum diverifikasi']);
        }elseif($agen3){
            return redirect()->route('agen.login')->with(['failed' => 'Akun tidak aktif']);
        }
        return redirect()->route('agen.login')->with(['failed' => 'Email/Kata sandi salah']);
    }

    public function logout()
    {
        \Session::flush();

        return redirect('/agen/login');
    }
}
