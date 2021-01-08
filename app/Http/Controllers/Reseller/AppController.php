<?php

namespace App\Http\Controllers\Reseller;
use App\Models\Reseller\Reseller;
use App\Models\Transaksi\Cart;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Pusat\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;

class AppController extends Controller
{
    public function dashboard()
    {
        $produk         = Produk::all();
        $id             = Session::get('id');
        $detail_reseller= DB::table('akun_reseller')
                            ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                            ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                            ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                            ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                            ->where('akun_reseller.id', $id)
                            ->first();

        $keranjang = Cart::where('id_reseller', $id)->get();
        $count_keranjang = count($keranjang);

        /* OMZET HARI INI */
        $tanggal = date('Y-m-d');
        $transaksi_hari_ini = HeadTransaksi::where('id_reseller', $id)->where('tgl_pesan', $tanggal)->sum('total_pembelian');

        /*OMZET MINGGU INI*/
        $transaksi_minggu_ini = HeadTransaksi::where('id_reseller', $id)
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

        /*$belum_bayar = HeadTransaksi::where('id_reseller', $id)->where('status', 'Menunggu pembayaran')->get();
        $count_belum_bayar = count($belum_bayar);

        $dikemas = HeadTransaksi::where('id_reseller', $id)->where('status', 'Dikemas')->get();
        $count_dikemas = count($dikemas);

        $dikirim = HeadTransaksi::where('id_reseller', $id)->where('status', 'Dikirim')->get();
        $count_dikirim = count($dikirim);*/

        return view('reseller.dashboard', compact('produk','id','detail_reseller','keranjang','count_keranjang','transaksi_hari_ini', 'transaksi_minggu_ini', 'transaksi_bulan_ini', 'transaksi_tahun_ini'));
    }

    public function profil()
    {
        return view('reseller.akun.profil');
    }

    public function ubah_foto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required',
        ]);

        $image = Session::get('image');

        $data = Reseller::where('image', $image)->first();
        $file = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/reseller/", $fileName);
        $data->image = $fileName;
        $data->save();

        return redirect()->route('reseller.profil')->with(['success' => 'Foto profil berhasil diubah']);
    }

    public function get_profil($id)
    {
        $data = Reseller::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function ubah_profil(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        
        $reseller = Reseller::where('id', $id)->first();
        $reseller->nama_lengkap = $request->nama_lengkap;
        $reseller->username = $request->username;
        $reseller->telepon = $request->telepon;
        $reseller->save();

        return response()->json($reseller);
    }
}
