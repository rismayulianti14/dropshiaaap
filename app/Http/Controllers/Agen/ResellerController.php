<?php

namespace App\Http\Controllers\Agen;
use App\Models\Reseller\Reseller;
use App\Models\Reseller\DetailReseller;
use App\Models\Reseller\EmailVerify;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailReseller;
use App\Excel\ExportReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use DB;
use Excel;
use PDF;
use Session;

class ResellerController extends Controller
{
    public function index()
    {
        $id = Session::get('id');
        $data = Reseller::where('id_agen', $id)->get();

        return view('agen.reseller.index', compact('data'));
    }

    public function rekapTransaksi($id)
    {
        $reseller = Reseller::find($id);
        $nama_lengkap = $reseller->nama_lengkap;
        $id_reseller = $reseller->id;
        $head_transaksi = HeadTransaksi::where('id_reseller', $id)->get();
        
        /* OMZET HARI INI */
        $tanggal = date('Y-m-d');
        $transaksi_hari_ini = HeadTransaksi::where('id_reseller', $id)->where('tgl_pesan', $tanggal)->sum('total_pembelian');

        /*OMZET MINGGU INI*/
        $omzet_minggu_ini = HeadTransaksi::where('id_reseller', $id)
                            ->where('tgl_pesan', '>', Carbon::now()->startOfWeek())
                            ->where('tgl_pesan', '<', Carbon::now()->endOfWeek())
                            ->sum('total_pembelian');
        
        /* OMZET BULAN INI */
        $bulan_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y-%m') bulan_ini"))
                        ->groupBy('bulan_ini')->orderBy('bulan_ini')->where('id_reseller', $id)->first();
        if($bulan_ini != null){
            $transaksi_bulan_ini = $bulan_ini->total;
        }else{
            $transaksi_bulan_ini = 0;
        }

        /* OMZET TAHUN INI */
        $tahun_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y') tahun_ini"))
                        ->groupBy('tahun_ini')->orderBy('tahun_ini')->where('id_reseller', $id)->first();
        if($tahun_ini != null){
            $transaksi_tahun_ini = $tahun_ini->total;
        }else{
            $transaksi_tahun_ini = 0;
        }

        /* TOTAL RESELLER */
        $reseller = Reseller::where('id', $id)->where('status', 1)->get();
        $total_reseller_aktif = count($reseller);

        /* TOTAL TRANSAKSI */
        $transaksi = HeadTransaksi::where('id_reseller', $id)->get();
        $jumlah_transaksi = count($transaksi);

        /* TOTAL OMZET */
        $total_transaksi = HeadTransaksi::where('id_reseller', $id)->sum('total_pembelian');

        /*GRAFIK PERBULAN*/
        $tgl = ['1','2','3','4','5','6','7','8','9','10',
                    '11','12','13','14','15','16','17','18','19','20',
                    '21','22','23','24','25','26','27','28','29','30','31'];
        for($i = 1; $i < 32; $i++){
            $data_perhari     = collect(DB::SELECT("SELECT count(total_pembelian) AS total from head_transaksi where day(tgl_pesan)='$i' and id_reseller='$id'"))->first();
            $grafik_perbulan[] = $data_perhari->total;
        }
        /* GRAFIK PERTAHUN */
        $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        for($i = 1; $i < 13; $i++){
            $data_perbulan     = collect(DB::SELECT("SELECT count(total_pembelian) AS total from head_transaksi where month(tgl_pesan)='$i' and id_reseller='$id'"))->first();
            $grafik_pertahun[] = $data_perbulan->total;  
        }

        return view('agen.reseller.rekap-transaksi', compact('reseller','nama_lengkap','id_reseller','head_transaksi','transaksi_hari_ini','transaksi_bulan_ini','transaksi_tahun_ini',
                    'total_reseller_aktif','jumlah_transaksi','total_transaksi','tgl','grafik_perbulan','bulan','grafik_pertahun'));
    }

    public function create()
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

        $provinsi = $this->get_provinsi();

        return view('agen.reseller.create', compact('provinsi','kode_id'));
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|email|max:100|unique:akun_reseller',
            'telepon' => 'required|unique:akun_reseller',
            'password' => 'required|min:6|max:100|unique:akun_reseller',
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

        $id_agen = Session::get('id');

        $reseller = new Reseller;
        $reseller->kode_id = $request->kode_id;
        $reseller->nama_lengkap = $request->nama_lengkap;
        $reseller->username = $request->username;
        $reseller->telepon = $request->telepon;
        $reseller->email = $request->email;
        $reseller->password = md5($request->password);
        $reseller->status = 1;
        $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/reseller/", $fileName);
        $reseller->image = $fileName;
        $reseller->email_verify = 0;
        $reseller->id_agen = $id_agen;
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
        $detail_reseller->id_reseller = $reseller->id;
        $detail_reseller->save();

        $tanggal = date('dmYhis');

        $email = new EmailVerify;
        $email->token = md5($tanggal);
        $email->user_id = $reseller->id;
        $email->status = 0;
        $email->save();

        $name = $request->nama_lengkap;
        $email = $request->email;
        $token = md5($tanggal); 
        $trigger = "email_verify";

        Mail::to($email)->send(new SendEmailReseller($name, $email, $token, $trigger));

        return redirect()->route('agen.reseller.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function email_verify($token)
    {
        $verifikasi = EmailVerify::where('token', $token)->first();

        if($verifikasi != null){
            $verifikasi->status = 1;
            $verifikasi->save();

            $petugas = Reseller::where('id', $verifikasi->user_id)->first();
            $petugas->email_verify = 1;
            $petugas->save();

            return view('reseller.email.berhasil-verifikasi');
        }else{
            echo "Gagal Verifikasi";
        }
    }

    public function ubah_status(Request $request)
    {
        $reseller = Reseller::find($request->user_id);
        $reseller->status = $request->status;
        $reseller->save();
  
        return response()->json(['success'=>'Ubah status berhasil']);
    }

    public function show($id)
    {
        $data = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->where('akun_reseller.id', $id)
                ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function edit($id)
    {
        $data = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->where('akun_reseller.id', $id)
                ->first();
        
        $provinsi = $this->get_provinsi();

        return view('agen.reseller.update', compact('data','provinsi'));
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
            $image->move(public_path('uploads/reseller'), $image_name);
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

        $reseller = array(
            'kode_id'       => $request->kode_id,
            'nama_lengkap'  => $request->nama_lengkap,
            'username'      => $request->username,
            'telepon'       => $request->telepon,
            'image'         => $image_name
        );

        $detail_reseller = array(
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
        Reseller::whereId($id)->update($reseller);
        DetailReseller::where('id_reseller', $id)->update($detail_reseller);

        return redirect()->route('agen.reseller.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function destroy($id)
    {
        $reseller = Reseller::find($id);
        $reseller->delete($$agen);

        $detail_reseller = DetailReseller::find($id);
        $detail_reseller->delete($detail_reseller);

        $email_verify = EmailVerify::find($id);
        $email_verify->delete($email_verify);

        $forgot_passwod = FogotPassword::find($id);
        $forgot_passwod->delete($forgot_passwod);

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function export_pdf()
    {
        $data = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->get();

        $pdf = PDF::loadview('agen.reseller.pdf', compact('data'));
        return $pdf->stream();
    }

    public function exportPdfRekapTransaksi($id)
    {
        $reseller = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->where('akun_reseller.id', $id)
                ->first();

        $head_transaksi = HeadTransaksi::where('id_reseller', $id)->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();

        $pdf = PDF::loadview('agen.reseller.pdf-rekap-transaksi', compact('head_transaksi','detail_transaksi','reseller'));
        return $pdf->stream();
    }

    public function export_excel()
    {
        return Excel::download(new ExportReseller, 'Reseller.xlsx');
    }
}
