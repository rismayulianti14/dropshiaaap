<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Petugas;
use App\Models\Reseller\Reseller;
use App\Models\Agen\Agen;
use App\Models\Transaksi\HeadTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;

class AppController extends Controller
{
    public function dashboard()
    {
        /* OMZET HARI INI */
        $tanggal = date('Y-m-d');
        $omzet_hari_ini = HeadTransaksi::where('tgl_pesan', $tanggal)->sum('total_pembelian');

        /*OMZET MINGGU INI*/
        $omzet_minggu_ini = HeadTransaksi::where('tgl_pesan', '>', Carbon::now()->startOfWeek())
                            ->where('tgl_pesan', '<', Carbon::now()->endOfWeek())
                            ->sum('total_pembelian');
        
        /* OMZET BULAN INI */
        $omzet_bulan_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y-%m') bulan_ini"))
                        ->groupBy('bulan_ini')->orderBy('bulan_ini')->first();

        /* OMZET TAHUN INI */
        $omzet_tahun_ini = HeadTransaksi::select(DB::raw('sum(total_pembelian) as `total`'),DB::raw("DATE_FORMAT(tgl_pesan, '%Y') tahun_ini"))
                        ->groupBy('tahun_ini')->orderBy('tahun_ini')->first();

        /* TOTAL RESELLER */
        $reseller_aktif = Reseller::where('status', 1)->get();
        $total_reseller_aktif = count($reseller_aktif);

        /* TOTAL AGEN */
        $agen_aktif = Agen::where('status', 1)->get();
        $total_agen_aktif = count($agen_aktif);

        /* TOTAL TRANSAKSI */
        $transaksi = HeadTransaksi::all();
        $total_transaksi = count($transaksi);

        /* TOTAL OMZET */
        $total_omzet = HeadTransaksi::all()->sum('total_pembelian');

        /* GRAFIK PERBULAN */
        $tgl = ['1','2','3','4','5','6','7','8','9','10',
                    '11','12','13','14','15','16','17','18','19','20',
                    '21','22','23','24','25','26','27','28','29','30','31'];
        for($i = 1; $i < 32; $i++){
            $data_perhari    = collect(DB::SELECT("SELECT IFNULL(COUNT(total_pembelian), 0) AS total from head_transaksi where day(tgl_pesan)='$i'"))->first();
            $grafik_perbulan[] = $data_perhari->total;
        }
        //dd($grafik_perbulan);

        /* GRAFIK PERTAHUN */
        $bulan = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        for($i = 1; $i < 13; $i++){
            $data_perbulan     = collect(DB::SELECT("SELECT IFNULL(COUNT(total_pembelian), 0) AS total from head_transaksi where month(tgl_pesan)='$i'"))->first();
            $grafik_pertahun[] = $data_perbulan->total;  
        }

        return view('pusat.dashboard', compact('total_reseller_aktif','total_agen_aktif','total_transaksi','total_omzet','omzet_hari_ini','omzet_minggu_ini','omzet_bulan_ini','omzet_tahun_ini',
                    'tgl','grafik_perbulan','bulan','grafik_pertahun'));
    }

    public function profil()
    {
        return view('pusat.akun.profil');
    }

    public function ubah_foto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required',
        ]);

        $image = Session::get('image');

        $data = Petugas::where('image', $image)->first();
        $file = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/petugas/", $fileName);
        $data->image = $fileName;
        $data->save();

        return redirect()->route('pusat.profil')->with(['success' => 'Foto profil berhasil diubah']);
    }

    public function get_profil($id)
    {
        $data = Petugas::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function ubah_profil(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        
        $petugas = Petugas::where('id', $id)->first();
        $petugas->nama_lengkap = $request->nama_lengkap;
        $petugas->username = $request->username;
        $petugas->telepon = $request->telepon;
        $petugas->posisi = $request->posisi;
        $petugas->save();

        return response()->json($petugas);
    }
}
