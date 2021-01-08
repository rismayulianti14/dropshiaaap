<?php

namespace App\Http\Controllers\Pusat\Transaksi;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Excel\ExportPesanan;
use Excel;
use DB;
use PDF;

class SemuaPesananController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::with('agen')->get();
        $count = count($head_transaksi);
        //dd($head_transaksi);

        return view('pusat.order.semua.index', compact('head_transaksi','count'));
    }

    public function detail($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->with('agen')->first();

        $id_agen = $head_transaksi->id_agen;
        $detail_agen = DB::table('akun_agen')
                        ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                        ->where('akun_agen.id', $id_agen)
                        ->first();

        $id_reseller = $head_transaksi->id_reseller;
        $detail_reseller = DB::table('akun_reseller')
                        ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                        ->where('akun_reseller.id', $id_reseller)
                        ->first();

        $detail_transaksi = DetailTransaksi::with('produk')->get();

        return view('pusat.order.semua.detail', compact('head_transaksi','detail_transaksi','detail_agen','detail_reseller'));
    }

    public function exportPdf()
    {
        $head_transaksi = HeadTransaksi::all();
        $detail_transaksi = DetailTransaksi::with('produk')->get();

        $pdf = PDF::loadview('pusat.order.semua.pdf', compact('head_transaksi','detail_transaksi'));
        return $pdf->stream();
    }

    public function exportExcel()
    {
        return Excel::download(new ExportPesanan, 'pesanan.xlsx');
    }
}
