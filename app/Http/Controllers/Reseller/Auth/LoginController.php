<?php

namespace App\Http\Controllers\Reseller\Auth;
use App\Models\Reseller\Reseller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('reseller.auth.login');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:100|email',
            'password' => 'required|min:6'
        ]);
 
        $email = $request->email;
        $password = md5($request->password);

        $reseller = Reseller::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 1)
                    ->first();
        
        $reseller2 = Reseller::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 0)
                    ->where('status', 1)
                    ->first();

        $reseller3 = Reseller::where('email', $email)
                    ->where('password', $password)
                    ->where('email_verify', 1)
                    ->where('status', 0)
                    ->first();

        if($reseller){
            \Session::put('id', $reseller->id);
            \Session::put('kode_id', $reseller->kode_id);
            \Session::put('nama_lengkap', $reseller->nama_lengkap);
            \Session::put('username', $reseller->username);
            \Session::put('email', $reseller->email);
            \Session::put('telepon', $reseller->telepon);
            \Session::put('status', $reseller->status); 
            \Session::put('image', $reseller->image);
            \Session::put('password', $reseller->password);
            \Session::put('id_agen', $reseller->id_agen);

            return redirect('/reseller/dashboard');
        }elseif($reseller2){
            return redirect()->route('reseller.login')->with(['failed' => 'Email belum diverifikasi']);
        }elseif($reseller3){
            return redirect()->route('reseller.login')->with(['failed' => 'Akun tidak aktif']);
        }
        return redirect()->route('reseller.login')->with(['failed' => 'Email/Kata sandi salah']);
    }

    public function logout()
    {
        \Session::flush();

        return redirect('/reseller/login');
    }
}
