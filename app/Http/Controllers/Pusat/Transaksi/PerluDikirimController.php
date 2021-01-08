<?php

namespace App\Http\Controllers\Pusat\Transaksi;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use PDF;

class PerluDikirimController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::where('status', 'Dikemas')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();
        $count = count($head_transaksi);
        //dd($head_transaksi);

        return view('pusat.order.perlu dikirim.index', compact('head_transaksi','detail_transaksi','count'));
    }

    public function detail($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

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

        return view('pusat.order.perlu dikirim.detail', compact('head_transaksi','detail_transaksi','detail_agen','detail_reseller'));
    }

    public function aturPengiriman($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

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

        $detail_transaksi = DetailTransaksi::where('id_head', $head_transaksi->id)->get();

        return view('pusat.order.perlu dikirim.atur-pengiriman', compact('head_transaksi','detail_agen','detail_transaksi','detail_reseller'));
    }

    public function storeAturPengiriman(Request $request, $no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan',$no_pesanan)->first();
        //dd($head_transaksi);
        if($head_transaksi->kurir == null){
            $request->validate([
                'kurir'    =>  'required',
                'layanan'    =>  'required',
                'no_resi'    =>  'required',
            ]);

            $total = 0;
            $layanan = '';
            $ongkir = 0;
            $subtotal = 0;

            $layanan = explode('-', $request->layanan);
            $service = $layanan[0];
            $ongkir = $layanan[1];

            $head_transaksi->no_resi = $request->no_resi;
            $head_transaksi->kurir = $request->kurir;
            $head_transaksi->layanan = $service;
            $head_transaksi->ongkir = 0;
            $head_transaksi->status = 'Dikirim';
            $head_transaksi->save();

            return redirect()->route('pusat.order.perlu-dikirim')->with(['success' => 'Pengiriman berhasil diatur, silahkan liat rincian di halaman pesanan dikirim']);
        }else{
            $request->validate([
                'no_resi'    =>  'required',
            ]);
            
            $head_transaksi->no_resi = $request->no_resi;
            $head_transaksi->status = 'Dikirim';
            $head_transaksi->save();

            return redirect()->route('pusat.order.perlu-dikirim')->with(['success' => 'Pengiriman berhasil diatur, silahkan liat rincian di halaman pesanan dikirim']);
        }
    }

    public function exportPdf()
    {
        $head_transaksi = HeadTransaksi::where('status', 'Dikemas')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();

        $pdf = PDF::loadview('pusat.order.perlu dikirim.pdf', compact('head_transaksi','detail_transaksi'));
        return $pdf->stream();
    }
}
