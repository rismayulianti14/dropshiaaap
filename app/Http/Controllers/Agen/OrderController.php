<?php

namespace App\Http\Controllers\Agen;
use App\Models\Pusat\Produk;
use App\Models\Pusat\Petugas;
use App\Models\Pusat\FotoProduk;
use App\Models\Agen\Agen;
use App\Models\Agen\DetailAgen;
use App\Models\Transaksi\Alamat;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Transaksi\Cart;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailPesanan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Session;
use DB;

class OrderController extends Controller
{
    public function product()
    {
        $produk         = Produk::where('stok', '>', 0)->get();
        $id             = Session::get('id');
        $detail_agen    = DB::table('akun_agen')
                            ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                            ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                            ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                            ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                            ->where('akun_agen.id', $id)
                            ->first();
                
        $keranjang = Cart::where('id_agen', $id)->get();
        $count_keranjang = count($keranjang);

        return view('agen.order.tambah-pesanan', compact('produk','detail_agen','count_keranjang'));
    }

    public function detailProduct($id)
    {
        $data = Produk::where('id', $id)
                ->with('foto_produk')
                ->first();
        $foto_produk = FotoProduk::get();

        $id_agen = Session::get('id');
        $detail_agen = DB::table('akun_agen')
                        ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                        ->where('akun_agen.id', $id_agen)
                        ->first();
        
        return view('agen.order.detail-produk', compact('data','foto_produk','detail_agen'));
    }

    public function addCart(Request $request)
    {
        $ids = $request->all();
        //dd($ids);
        $res = [];

        if(request()->ajax())
        {
            $id = $request->ids;
            
            if(isset($id))
            {
                $produk = Produk::whereIn('id', $id)->get();
                $id_agen = Session::get('id');
                $detail_agen = DB::table('akun_agen')
                            ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                            ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                            ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                            ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                            ->where('akun_agen.id', $id_agen)
                            ->first();

                foreach($produk as $key=>$row){
                    if($detail_agen->kota == 151 || $detail_agen->kota == 152 || $detail_agen->kota == 153 || $detail_agen->kota == 154 || $detail_agen->kota == 155 ||
                    $detail_agen->kota == 78 || $detail_agen->kota == 79 || $detail_agen->kota == 54 || $detail_agen->kota == 55 || $detail_agen->kota == 115 ||
                    $detail_agen->kota == 455 || $detail_agen->kota == 456 || $detail_agen->kota == 457){

                        $harga = $row->jabodetabek->harga_agen_jabodetabek;

                    }elseif($detail_agen->provinsi == 9 || $detail_agen->provinsi == 10 || $detail_agen->provinsi == 11 || $detail_agen->provinsi == 5 || $detail_agen->provinsi == 3){

                            $harga = $row->pulau_jawa->harga_agen_pjawa;

                    }else{
                        $harga = $row->luar_pulau_jawa->harga_agen_lpjawa;
                    }

                    $cart = array(
                        'id_produk' => $row->id,
                        'harga' => $harga,
                        'qty' => 1,
                        'subtotal' => $harga,
                        'berat' => $row->berat,
                        'id_agen' => $id_agen
                    );
                    Cart::create($cart);
                    $res[] = $cart;
                }
                //dd($res);
                return response()->json($cart);
            }   
            else
            {
                return "gagal";
            }
        }
    }

    public function cart()
    {
        $tanggal = date('Y-m-d');
        $id_agen = Session::get('id');

        /*--- NO PESANAN ---*/
        $noUrutAkhir = HeadTransaksi::max('id');
        $no = 1;

        if($noUrutAkhir) {
            $no_awal = date('ymd');
            $tgl = 'PG';
            $no_urut = sprintf("%04s", abs($noUrutAkhir + 1));

            $no_pesanan = $no_awal . $tgl . $no_urut;
        }
        else {            
            $no_awal = date('ymd');
            $tgl = 'PG';
            $no_urut = sprintf("%04s", $no);

            $no_pesanan = $no_awal . $tgl . $no_urut;
        }

        $detail_agen = DB::table('akun_agen')
                        ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                        ->where('akun_agen.id', $id_agen)
                        ->first();
        
        $cart = Cart::with('produk')->where('id_agen', $id_agen)->get();
        $count_cart = count($cart);

        return view('agen.order.checkout', compact('detail_agen','tanggal','no_pesanan','cart','count_cart'));
    }

    public function updateCart(Request $request, $id_agen)
    {
        $cart = Cart::where('id_agen', $id_agen)->where('id_reseller', null)->get();

        foreach($cart as $key=>$row){
            $updateCart = Cart::find($request->id[$key]);
            $updateCart->qty = $request->qty[$key];
            $updateCart->berat = $request->berat[$key];
            $updateCart->subtotal = $request->subtotal[$key];
            $updateCart->save();
        }
        //dd($updateCart);
        
        return redirect()->back()->with(['success' => 'Keranjang berhasil diperbaharui']);
    }

    public function destroyProduct($id)
    {
        $cart = Cart::find($id);
        $cart->delete($cart);

        return redirect()->back();
    }

    public function getOngkir($origin, $destination, $weight, $courier)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin=$origin&originType=subdistrict&destination=$destination&destinationType=subdistrict&weight=$weight&courier=$courier",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
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
            $data_ongkir = $response['rajaongkir']['results'];
            return json_encode($data_ongkir);
        }
    }

    public function checkoutLJawa(Request $request)
    {
        $validatedData = $request->validate([
            'kurir' => 'required',
            'layanan' => 'required',
        ]);

        $id_agen = Session::get('id');
        $total = 0;
        $layanan = '';
        $ongkir = 0;
        $subtotal = 0;

        $layanan = explode('-', $request->layanan);
        $service = $layanan[0];
        $ongkir = $layanan[1];

        $cart = Cart::where('id_agen', $id_agen)->get();
        foreach($cart as $cart){
            $subtotal += $cart->subtotal;
        }
        $grand_total = $subtotal + $ongkir;

        $head_transaksi = new HeadTransaksi;
        $head_transaksi->no_pesanan = $request->no_pesanan;
        $head_transaksi->id_agen = $request->id_agen;
        $head_transaksi->total_pembelian = $subtotal;
        $head_transaksi->kurir = $request->kurir;
        $head_transaksi->layanan = $service;
        $head_transaksi->ongkir = $ongkir;
        $head_transaksi->grand_total = $grand_total;
        $head_transaksi->catatan = $request->catatan;
        $head_transaksi->tgl_pesan = $request->tgl_pesan;
        $head_transaksi->status = 'Menunggu pembayaran';
        $head_transaksi->save();

        // --------- INSERT DATA DETAIL TRANSAKSI ( TABEL DETAIL TRANSACTION ) -----------//
        $id_head = $head_transaksi->id;
        $detail_transaksi = DB::select(DB::raw("INSERT INTO detail_transaksi (id_produk, harga, qty, berat, subtotal, id_head) SELECT id_produk, harga, qty, berat,subtotal,'$id_head' FROM cart WHERE id_agen='$id_agen'"));
        
        // --------- DELETE DATA CART ( TABEL CART ) -----------//
        $cart = Cart::where('id_agen', $id_agen)->get();
        $deleteCart = [];
        foreach($cart as $row){
            $deleteCart[] = Cart::where('id', $row->id)->delete();
        }

        $id_agen = $head_transaksi->id_agen;
        $agen = Agen::find($id_agen);

        $nama_lengkap = $agen->nama_lengkap;
        $email = $agen->email;
        $no_pesanan = $head_transaksi->no_pesanan;
        $total = $grand_total;
        $trigger = "pesanan_dikonfirmasi";

        //dd($token);

        Mail::to($email)->send(new SendEmailPesanan($nama_lengkap, $email, $no_pesanan, $total, $trigger));

        return redirect()->route('agen.order.invoice', $head_transaksi->no_pesanan);
    }

    public function checkoutPJawa(Request $request)
    {
        $id_agen = Session::get('id');
        $subtotal = 0;

        $cart = Cart::where('id_agen', $id_agen)->get();
        foreach($cart as $cart){
            $subtotal += $cart->subtotal;
        }

        $head_transaksi = new HeadTransaksi;
        $head_transaksi->no_pesanan = $request->no_pesanan;
        $head_transaksi->id_agen = $request->id_agen;
        $head_transaksi->total_pembelian = $subtotal;
        $head_transaksi->ongkir = 0;
        $head_transaksi->grand_total = $subtotal;
        $head_transaksi->catatan = $request->catatan;
        $head_transaksi->tgl_pesan = $request->tgl_pesan;
        $head_transaksi->status = 'Menunggu pembayaran';
        $head_transaksi->save();
        
        // --------- INSERT DATA DETAIL TRANSAKSI ( TABEL DETAIL TRANSACTION ) -----------//
        $id_head = $head_transaksi->id;
        $detail_transaksi = DB::select(DB::raw("INSERT INTO detail_transaksi (id_produk, harga, qty, berat, subtotal, id_head) SELECT id_produk, harga, qty, berat,subtotal,'$id_head' FROM cart WHERE id_agen='$id_agen'"));
        
        // --------- DELETE DATA CART ( TABEL CART ) -----------//
        $cart = Cart::where('id_agen', $id_agen)->get();
        $deleteCart = [];
        foreach($cart as $row){
            $deleteCart[] = Cart::where('id', $row->id)->delete();
        }

        $id_agen = $head_transaksi->id_agen;
        $agen = Agen::find($id_agen);

        $nama_lengkap = $agen->nama_lengkap;
        $email = $agen->email;
        $no_pesanan = $head_transaksi->no_pesanan;
        $total = $subtotal;
        $trigger = "pesanan_dikonfirmasi";

        //dd($token);

        Mail::to($email)->send(new SendEmailPesanan($nama_lengkap, $email, $no_pesanan, $total, $trigger));

        return redirect()->route('agen.order.invoice', $head_transaksi->no_pesanan);
    }

    public function invoice($no_pesanan)
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

        $detail_transaksi = DetailTransaksi::with('produk')->get();

        return view('agen.order.invoice', compact('head_transaksi','detail_transaksi','detail_agen'));
    }

    public function payment($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        return view('agen.order.bayar', compact('head_transaksi'));
    }

    public function confirmationPaymet($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        return view('agen.order.konfirmasi-pembayaran', compact('head_transaksi'));
    }

    public function storeConfirmationPayment(Request $request, $no_pesanan)
    {
        $validatedData = $request->validate([
            'bukti_tf' => 'required'
        ]);

        $head_transaksi = HeadTransaksi::where('no_pesanan',$no_pesanan)->first();

            $file       = $request->file('bukti_tf');
            $fileName   = $file->getClientOriginalName();
            $request->file('bukti_tf')->move("uploads/buktiTf/", $fileName);
        $head_transaksi->bukti_tf = $fileName;
        $head_transaksi->status = 'Dikemas';
        $head_transaksi->save();
        //dd($head_transaksi);

        return redirect()->route('agen.order.berhasil-konfirmasi');
    }

    public function successConfirmation()
    {
        return view('agen.order.selesai');
    }
}
