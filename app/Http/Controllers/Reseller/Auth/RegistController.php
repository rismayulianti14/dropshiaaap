<?php

namespace App\Http\Controllers\Reseller\Auth;
use App\Models\Reseller\Reseller;
use App\Models\Reseller\DetailReseller;
use App\Models\Reseller\EmailVerify;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistController extends Controller
{
    public function register()
    {
        /*--- ID RESELLER ---*/
        $noUrutAkhir = Reseller::max('id');
        $no = 1;

        if($noUrutAkhir) {
            $no_awal = 'JD';
            $no_urut = sprintf("%04s", abs($noUrutAkhir + 1));
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }
        else {            
            $no_awal = 'JD';
            $no_urut = sprintf("%04s", $no);
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }

        return view('reseller.auth.register', compact('kode_id'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|email|max:100|unique:akun_reseller',
            'telepon' => 'required',
            'password' => 'required|min:6|max:100|unique:akun_reseller',
        ]);

        $reseller = new Reseller;
        $reseller->kode_id = $request->kode_id;
        $reseller->nama_lengkap = $request->nama_lengkap;
        $reseller->username = $request->username;
        $reseller->telepon = $request->telepon;
        $reseller->email = $request->email;
        $reseller->password = md5($request->password);
        $reseller->status = 0;
        $reseller->email_verify = 0;
        $reseller->id_agen = 0;
        $reseller->save();

        return redirect()->route('reseller.register-detail', $reseller->id);
    }

    public function get_provinsi()
    {   
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 09152fd0704577b8da71b0c06478e475"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
             echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response,true);
            $provinsi = $response['rajaongkir']['results'];
            return $provinsi;
        }    
    }

    public function get_kota($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/city?&province=$id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "key: 09152fd0704577b8da71b0c06478e475"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $response = json_decode($response,true);
            $kota = $response['rajaongkir']['results'];
            return json_encode($kota);
        }
    }

    public function register_detail($id)
    {
        $reseller = Reseller::find($id);
        $provinsi = $this->get_provinsi();

        return view('reseller.auth.register-detail', compact('reseller','provinsi'));
    }

    public function store_detail(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required|max:2048',

            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'kode_pos' => 'required|numeric',
            'alamat_detail' => 'required',
            'pekerjaan' => 'required',
            'tempat_lahir' => 'required|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required'
        ]);

        $reseller = Reseller::find($id);
        $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/reseller/", $fileName);
        $reseller->image = $fileName;
        $reseller->save();

        $detail_reseller = new DetailReseller;
        $detail_reseller->provinsi = $request->provinsi;
        $detail_reseller->kota = $request->kota;
        $detail_reseller->kecamatan = $request->kecamatan;
        $detail_reseller->kode_pos = $request->kode_pos;
        $detail_reseller->alamat_detail = $request->alamat_detail;
        $detail_reseller->tempat_lahir = $request->tempat_lahir;
        $detail_reseller->tanggal_lahir = $request->tanggal_lahir;
        $detail_reseller->jenis_kelamin = $request->jenis_kelamin;
        $detail_reseller->pekerjaan = $request->pekerjaan;
        $detail_reseller->id_reseller = $id;
        $detail_reseller->save();

        $tanggal = date('dmYhis');

        $data = Reseller::where('id', $id)->first();

        $email = new EmailVerify;
        $email->token = md5($tanggal);
        $email->user_id = $data->id;
        $email->status = 0;
        $email->save();

        $name = $data->nama_lengkap;
        $email = $data->email;
        $token = md5($tanggal);
        $trigger = "email_verify";

        Mail::to($email)->send(new SendEmailReseller($name, $email, $token, $trigger));

        return redirect()->route('reseller.register.berhasil', $data->id);
    }

    public function berhasil($id)
    {
        $data = Reseller::find($id);

        return view('reseller.auth.berhasil-registrasi', compact('data'));
    }
}
