<?php

namespace App\Http\Controllers\Reseller\RiwayatPembelian;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class DiterimaController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::where('id_reseller', Session::get('id'))->where('status', 'Diterima')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();
        $count = count($head_transaksi);
        //dd($detail_transaksi);

        return view('reseller.riwayat pembelian.diterima.index', compact('head_transaksi','count','detail_transaksi'));
    }
}
