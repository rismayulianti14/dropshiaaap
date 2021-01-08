<?php

namespace App\Http\Controllers\Pusat\Auth;
use App\Models\Pusat\Petugas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pusat.auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:100|email',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->email;
        $password = md5($request->password);

        $petugas = Petugas::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 1)
                    ->first();
        
        $petugas2 = Petugas::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 0)
                    ->where('status', 1)
                    ->first();

        $petugas3 = Petugas::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 0)
                    ->first();

        if($petugas){
            \Session::put('id', $petugas->id);
            \Session::put('nama_lengkap', $petugas->nama_lengkap);
            \Session::put('username', $petugas->username);
            \Session::put('email', $petugas->email);
            \Session::put('telepon', $petugas->telepon);
            \Session::put('posisi', $petugas->posisi); 
            \Session::put('status', $petugas->status); 
            \Session::put('image', $petugas->image);
            \Session::put('password', $petugas->password);

            return redirect('/pusat/dashboard');
        }elseif($petugas2){
            return redirect()->route('pusat.login')->with(['failed' => 'Email belum diverifikasi']);
        }elseif($petugas3){
            return redirect()->route('pusat.login')->with(['failed' => 'Akun tidak aktif']);
        }
        return redirect()->route('pusat.login')->with(['failed' => 'Email/Kata sandi salah']);
    }

    public function logout()
    {
        \Session::flush();

        return redirect('/pusat/login');
    }
}
