<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Agen\Agen;
use App\Models\Agen\DetailAgen;
use App\Models\Agen\EmailVerify;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Transaksi\Profit;
use App\Models\Reseller\Reseller;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailAgen;
use App\Mail\SendEMailProfit;
use App\Excel\ExportAgen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;
use Excel;
use PDF;

class AgenController extends Controller
{
    public function index()
    {
        $data = Agen::orderBy('status', 'DESC')->get();

        return view('pusat.agen.index', compact('data'));
    }

    public function create()
    {
        /*--- ID AGEN ---*/
        $noUrutAkhir = Agen::max('id');
        $no = 1;

        if($noUrutAkhir) {
            $no_awal = 'PG';
            $no_urut = sprintf("%03s", abs($noUrutAkhir + 1));
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }
        else {            
            $no_awal = 'PG';
            $no_urut = sprintf("%04s", $no);
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }

        //$negara = $this->get_negara();
        $provinsi = $this->getProvince();

        return view('pusat.agen.create', compact('provinsi','kode_id'));
    }

    /*public function getNegara()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/v2/internationalDestination",
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
            $negara = $response['rajaongkir']['results'];
            return $negara;
        }

    }*/

    public function getProvince()
    {   
        $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
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

    public function getCity($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/city?&province=$id",
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

    public function getSubdistrict($id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=$id",
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
            $kecamatan = $response['rajaongkir']['results'];
            return json_encode($kecamatan);
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|email|max:100|unique:akun_agen',
            'telepon' => 'required|unique:akun_agen',
            'password' => 'required|min:6|max:100|unique:akun_agen',
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

        $agen = new Agen;
        $agen->kode_id = $request->kode_id;
        $agen->nama_lengkap = $request->nama_lengkap;
        $agen->username = $request->username;
        $agen->telepon = $request->telepon;
        $agen->email = $request->email;
        $agen->password = md5($request->password);
        $agen->status = 1;
        $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/agen/", $fileName);
        $agen->image = $fileName;
        $agen->email_verify = 0;
        $agen->save();

        $detail_agen = new DetailAgen;
        $detail_agen->provinsi = $request->provinsi;
        $detail_agen->kota = $request->kota;
        $detail_agen->kecamatan = $request->kecamatan;
        $detail_agen->kode_pos = $request->kode_pos;
        $detail_agen->alamat_detail = $request->alamat_detail;
        $detail_agen->tempat_lahir = $request->tempat_lahir;
        $detail_agen->tanggal_lahir = $request->tanggal_lahir;
        $detail_agen->jenis_kelamin = $request->jenis_kelamin;
        $detail_agen->pekerjaan = $request->pekerjaan;
        $detail_agen->id_agen = $agen->id;
        $detail_agen->save();

        $tanggal = date('dmYhis');

        $email = new EmailVerify;
        $email->token = md5($tanggal);
        $email->user_id = $agen->id;
        $email->status = 0;
        $email->save();

        $name = $request->nama_lengkap;
        $email = $request->email;
        $token = md5($tanggal);
        $trigger = "email_verify";

        Mail::to($email)->send(new SendEmailAgen($name, $email, $token, $trigger));

        return redirect()->route('pusat.agen.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function emailVerify($token)
    {
        $verifikasi = EmailVerify::where('token', $token)->first();

        if($verifikasi != null){
            $verifikasi->status = 1;
            $verifikasi->save();

            $petugas = Agen::where('id', $verifikasi->user_id)->first();
            $petugas->email_verify = 1;
            $petugas->save();

            return view('agen.email.berhasil-verifikasi');
        }else{
            echo "Gagal Verifikasi";
        }
    }

    public function rekapTransaksi($id)
    {
        $agen = Agen::where('id', $id)->first();
        $head_transaksi = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)->get();

        
        /* OMZET HARI INI */
        $tanggal = date('Y-m-d');
        $transaksi_hari_ini = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)->where('tgl_pesan', $tanggal)->sum('total_pembelian');

        /*OMZET MINGGU INI*/
        $transaksi_minggu_ini = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)
                            ->where('tgl_pesan', '>', Carbon::now()->startOfWeek())
                            ->where('tgl_pesan', '<', Carbon::now()->endOfWeek())
                            ->sum('total_pembelian');
        
        /* OMZET BULAN INI */
        $bulan_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y-%m') bulan_ini"))
                        ->groupBy('bulan_ini')->orderBy('bulan_ini')->where('id_agen', $id)->where('id_reseller', null)->first();
        if($bulan_ini != null){
            $transaksi_bulan_ini = $bulan_ini->total;
        }else{
            $transaksi_bulan_ini = 0;
        }
        
        /* OMZET TAHUN INI */
        $tahun_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y') tahun_ini"))
                        ->groupBy('tahun_ini')->orderBy('tahun_ini')->where('id_agen', $id)->where('id_reseller', null)->first();
        if($tahun_ini != null){
            $transaksi_tahun_ini = $tahun_ini->total;
        }else{
            $transaksi_tahun_ini = 0;
        }

        /* PROFIT BELUM DITARIK */
        $profit = Profit::where('id_agen', $id)->first();
        if($profit == null){
            $id_agen = 0;
            $profit_agen = 0;
        }else{
            $id_agen = $profit->id_agen;
            $profit_agen = $profit->profit;
        }

        /* TOTAL RESELLER */
        $reseller = Reseller::where('id_agen', $id)->where('status', 1)->get();
        $total_reseller_aktif = count($reseller);

        /* TOTAL TRANSAKSI */
        $transaksi = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)->get();
        $jumlah_transaksi = count($transaksi);

        /* TOTAL OMZET */
        $total_transaksi = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)->sum('total_pembelian');

        /*GRAFIK PERBULAN*/
        $tgl = ['1','2','3','4','5','6','7','8','9','10',
                    '11','12','13','14','15','16','17','18','19','20',
                    '21','22','23','24','25','26','27','28','29','30','31'];
        for($i = 1; $i < 32; $i++){
            $data_perhari     = collect(DB::SELECT("SELECT count(total_pembelian) AS total from head_transaksi where day(tgl_pesan)='$i' and id_agen='$id'
                                or id_agen='$id' and id_reseller=null "))->first();
            $grafik_perbulan[] = $data_perhari->total;
        }
        
        /* GRAFIK PERTAHUN */
        $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        for($i = 1; $i < 13; $i++){
            $data_perbulan     = collect(DB::SELECT("SELECT count(total_pembelian) AS total from head_transaksi where month(tgl_pesan)='$i' and id_agen='$id'
                                or id_agen='$id' and id_reseller=null "))->first();
            $grafik_pertahun[] = $data_perbulan->total;  
        }
        
        return view('pusat.agen.rekap-transaksi', compact('agen','head_transaksi','transaksi_hari_ini','transaksi_minggu_ini','transaksi_bulan_ini','transaksi_tahun_ini',
                    'total_reseller_aktif','jumlah_transaksi','total_transaksi','tgl','grafik_perbulan','bulan','grafik_pertahun','profit_agen','id_agen'));
    }

    /*public function transferProfit($id)
    {
        $agen = Agen::where('id', $id)->first();
        $profit = Profit::where('id_agen', $id)->first();

        return view('pusat.agen.transfer-profit', compact('agen', 'profit'));
    }*/

    public function storeTransferProfit(Request $request, $id)
    {
        $profit = Profit::where('id_agen', $id)->first();
        $profit_awal = $profit->profit;
        
        $profit->profit = 0;
        $profit->save();
        //dd($profit);

        $agen = Agen::where('id', $profit->id_agen)->first();
        $tanggal = date('dmYhis');

        $name = $agen->nama_lengkap;
        $email = $agen->email;
        $profit = $profit_awal;
        $token = md5($tanggal);
        $trigger = "penarikan_profit";

        Mail::to($email)->send(new SendEmailProfit($name, $email, $profit, $token, $trigger));

        return redirect()->back();
    }

    public function show($id)
    {
        $data = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->where('akun_agen.id', $id)
                ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $data = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->where('akun_agen.id', $id)
                ->first();
        
        $provinsi = $this->getProvince();

        return view('pusat.agen.update', compact('data','provinsi'));
    }

    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'nama_lengkap'  => 'required|max:100',
                'username'      => 'required|max:100',
                'telepon'       => 'required',
                'image'         => 'required|max:2048',

                'provinsi'      => 'required',
                'kota'          => 'required',
                'kecamatan'     => 'required',
                'kode_pos'      => 'required|numeric',
                'alamat_detail' => 'required',
                'pekerjaan'     => 'required',
                'tempat_lahir'  => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required'
            ]);

            $image_name = $image->getClientOriginalName();
            $image->move(public_path('uploads/agen'), $image_name);
        }
        else
        {
            $request->validate([
                'nama_lengkap'  => 'required|max:100',
                'username'      => 'required|max:100',
                'telepon'       => 'required',

                'provinsi'      => 'required',
                'kota'          => 'required',
                'kecamatan'     => 'required',
                'kode_pos'      => 'required|numeric',
                'alamat_detail' => 'required',
                'pekerjaan'     => 'required',
                'tempat_lahir'  => 'required|max:100',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required'
            ]);
        }

        $agen = array(
            'kode_id'       => $request->kode_id,
            'nama_lengkap'  => $request->nama_lengkap,
            'username'      => $request->username,
            'telepon'       => $request->telepon,
            'image'         => $image_name
        );

        $detail_agen = array(
            'provinsi'      => $request->provinsi,
            'kota'          => $request->kota,
            'kecamatan'     => $request->kecamatan,
            'kode_pos'      => $request->kode_pos,
            'alamat_detail' => $request->alamat_detail,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'pekerjaan'     => $request->pekerjaan,
        );

        //dd($detail_agen);
        Agen::whereId($id)->update($agen);
        DetailAgen::where('id_agen', $id)->update($detail_agen);

        return redirect()->route('pusat.agen.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function updateStatus(Request $request)
    {
        $agen = Agen::find($request->user_id);
        $agen->status = $request->status;
        $agen->save();
  
        return response()->json(['success'=>'Ubah status berhasil']);
    }

    public function destroy($id)
    {
        $agen = Agen::find($id);
        $agen->delete($agen);

        $detail_agen = DetailAgen::find($id);
        $detail_agen->delete($detail_agen);

        $email_verify = EmailVerify::find($id);
        $email_verify->delete($email_verify);

        $forgot_password = ForgotPassword::find($id);
        $forgot_password->delete($forgot_password);

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function exportExcel()
    {
        return Excel::download(new ExportAgen, 'agen.xlsx');
    }

    public function exportPdf()
    {
        $data = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->get();

        $pdf = PDF::loadview('pusat.agen.pdf', compact('data'));
        return $pdf->stream();
    }

    public function exportPdfRekapTransaksi($id)
    {
        $agen = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->where('akun_agen.id', $id)
                ->first();

        $head_transaksi = HeadTransaksi::where('id_agen', $id)->where('id_reseller', null)->get();
        $detail_transaksi = DetailTransaksi::get();
        
        $pdf = PDF::loadview('pusat.agen.pdf-rekap-transaksi', compact('head_transaksi','detail_transaksi','agen'));
        return $pdf->stream();
    }
}
