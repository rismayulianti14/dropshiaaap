<?php

namespace App\Http\Controllers\Reseller\RiwayatPembelian;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;

class DikemasController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::where('id_reseller', Session::get('id'))->where('status', 'Dikemas')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();
        $count = count($head_transaksi);
        //dd($id);

        return view('reseller.riwayat pembelian.dikemas.index', compact('head_transaksi','count','detail_transaksi'));
    }
}
