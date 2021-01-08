<?php

namespace App\Http\Controllers\Agen\RiwayatPembelian;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Agen\Agen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class DiterimaController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::where('id_agen', Session::get('id'))->where('status', 'Diterima')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();
        $count = count($head_transaksi);
        //dd($detail_transaksi);

        return view('agen.riwayat pembelian.diterima.index', compact('head_transaksi','count','detail_transaksi'));
    }

    public function detail($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('id_agen', Session::get('id'))->where('no_pesanan', $no_pesanan)->first();

        $id_agen = $head_transaksi->id_agen;
        $detail_agen = DB::table('akun_agen')
                        ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                        ->where('akun_agen.id', $id_agen)
                        ->first();

        $detail_transaksi = DetailTransaksi::with('produk')->get();

        return view('agen.riwayat pembelian.diterima.detail', compact('head_transaksi','detail_transaksi','detail_agen'));
    }
}
