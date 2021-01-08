<?php

namespace App\Http\Controllers\Pusat\Reseller;
use App\Models\Reseller\Reseller;
use App\Http\Controllers\Controller;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Excel\ExportResellerAktif;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Excel;
use PDF;

class ResellerAktifController extends Controller
{
    public function index()
    {
        $reseller = Reseller::where('status', 1)->with('agen')->get();

        return view('pusat.reseller.reseller-aktif', compact('reseller'));
    }

    public function rekapTransaksi($id)
    {
        $reseller = Reseller::where('id', $id)->first();
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

        return view('pusat.reseller.rekap-transaksi', compact('reseller','nama_lengkap','id_reseller','head_transaksi','transaksi_hari_ini','transaksi_bulan_ini','transaksi_tahun_ini',
                    'total_reseller_aktif','jumlah_transaksi','total_transaksi','tgl','grafik_perbulan','bulan','grafik_pertahun'));
    }

    public function exportPdf()
    {
        $data = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->where('akun_reseller.status', 1)
                ->get();

        $pdf = PDF::loadview('pusat.reseller.pdf', compact('data'));
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

    public function exportExcel()
    {
        return Excel::download(new ExportResellerAktif, 'Reseller-aktif.xlsx');
    }
}
