<?php

namespace App\Http\Controllers\Reseller;
use App\Models\Pusat\Produk;
use App\Models\Pusat\FotoProduk;
use App\Models\Reseller\Reseller;
use App\Models\Reseller\DetailReseller;
use App\Models\Transaksi\Alamat;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Transaksi\Cart;
use App\Models\Transaksi\Profit;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailPesanan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use DB;
use Session;

class OrderController extends Controller
{
    public function product()
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

        return view('reseller.order.tambah-pesanan', compact('produk','detail_reseller','count_keranjang'));
    }

    public function detailProduct($id)
    {
        $data = Produk::where('id', $id)
                ->with('foto_produk')
                ->first();
        $foto_produk = FotoProduk::get();

        $id_reseller = Session::get('id');
        $detail_reseller = DB::table('akun_reseller')
                        ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                        ->where('akun_reseller.id', $id_reseller)
                        ->first();
        
        return view('reseller.order.detail-produk', compact('data','foto_produk','detail_reseller'));
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
                $id_reseller = Session::get('id');
                $id_agen = Session::get('id_agen');
                $detail_reseller = DB::table('akun_reseller')
                                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                                ->where('akun_reseller.id', $id_reseller)
                                ->first();

                foreach($produk as $key=>$row){
                    if($detail_reseller->kota == 151 || $detail_reseller->kota == 152 || $detail_reseller->kota == 153 || $detail_reseller->kota == 154 || $detail_reseller->kota == 155 ||
                    $detail_reseller->kota == 78 || $detail_reseller->kota == 79 || $detail_reseller->kota == 54 || $detail_reseller->kota == 55 || $detail_reseller->kota == 115 ||
                    $detail_reseller->kota == 455 || $detail_reseller->kota == 456 || $detail_reseller->kota == 457){

                        $harga = $row->jabodetabek->harga_reseller_jabodetabek;
                        $harga_agen = $row->jabodetabek->harga_agen_jabodetabek;

                    }elseif($detail_reseller->provinsi == 9 || $detail_reseller->provinsi == 10 || $detail_reseller->provinsi == 11 || $detail_reseller->provinsi == 5 || $detail_reseller->provinsi == 3){

                        $harga = $row->pulau_jawa->harga_reseller_pjawa;
                        $harga_agen = $row->pulau_jawa->harga_agen_pjawa;

                    }else{
                        $harga = $row->luar_pulau_jawa->harga_reseller_lpjawa;
                        $harga_agen = $row->luar_pulau_jawa->harga_agen_lpjawa;
                    }

                    $cart = array(
                        'id_produk' => $row->id,
                        'harga' => $harga,
                        'qty' => 1,
                        'subtotal' => $harga,
                        'berat' => $row->berat,
                        'id_agen' => $id_agen,
                        'id_reseller' => $id_reseller,
                        'subtotal_harga_agen' => $harga_agen
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
        $id_reseller = Session::get('id');

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

        $detail_reseller = DB::table('akun_reseller')
                                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                                ->where('akun_reseller.id', $id_reseller)
                                ->first();
        
        $cart = Cart::with('produk')->where('id_reseller', $id_reseller)->get();
        $count_cart = count($cart);

        return view('reseller.order.checkout', compact('detail_reseller','tanggal','no_pesanan','cart','count_cart'));
    }

    public function updateCart(Request $request, $id_reseller)
    {
        $cart = Cart::where('id_reseller', $id_reseller)->get();

        foreach($cart as $key=>$row){
            $updateCart = Cart::find($request->id[$key]);
            $updateCart->qty = $request->qty[$key];
            $updateCart->berat = $request->berat[$key];
            $updateCart->subtotal = $request->subtotal[$key];
            $updateCart->subtotal_harga_agen = $request->subtotal_harga_agen[$key];
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

        $id_agen = Session::get('id_agen');
        $id_reseller = Session::get('id');
        $total = 0;
        $layanan = '';
        $ongkir = 0;
        $subtotal = 0;

        $layanan = explode('-', $request->layanan);
        $service = $layanan[0];
        $ongkir = $layanan[1];

        $cart = Cart::where('id_reseller', $id_reseller)->get();
        foreach($cart as $cart){
            $subtotal += $cart->subtotal;
        }
        $grand_total = $subtotal + $ongkir;

        $head_transaksi = new HeadTransaksi;
        $head_transaksi->no_pesanan = $request->no_pesanan;
        $head_transaksi->id_agen = $request->id_agen;
        $head_transaksi->id_reseller = $request->id_reseller;
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
        $detail_transaksi = DB::select(DB::raw("INSERT INTO detail_transaksi (id_produk, harga, qty, berat, subtotal, id_head) SELECT id_produk, harga, qty, berat,subtotal,'$id_head' FROM cart WHERE id_reseller='$id_reseller'"));
        
        $cart = Cart::where('id_reseller', $id_reseller)->get();

        // --------- INSERT TABLE PROFIT AGEN -----------//
        $total_harga_reseller = DB::table('cart')->where('id_reseller', $id_reseller)->sum('subtotal');
        $total_harga_agen = DB::table('cart')->where('id_reseller', $id_reseller)->sum('subtotal_harga_agen');
        
        $profit_agen = $total_harga_reseller - $total_harga_agen;

        $data_profit = Profit::where('id_agen', $head_transaksi->id_agen)->first();
        if($data_profit == null){
            $newProfit = new Profit;
            $newProfit->id_agen = $head_transaksi->id_agen;
            $newProfit->profit = $profit_agen;
            $newProfit->save();
        }elseif($data_profit->profit > 0){
            $newProfit = Profit::where('id_agen', $head_transaksi->id_agen)->first();

            $akumulasi_profit = $newProfit->profit + $profit_agen;

            $newProfit->profit = $akumulasi_profit;
            $newProfit->save();
        }elseif($data_profit->profit == 0){
            $newProfit = Profit::where('id_agen', $head_transaksi->id_agen)->first();
            $newProfit->profit = $profit_agen;
            $newProfit->save();
        }

        // --------- DELETE DATA CART ( TABEL CART ) -----------//
        $deleteCart = [];
        foreach($cart as $row){
            $deleteCart[] = Cart::where('id', $row->id)->delete();
        }

        $reseller = Reseller::find($id_reseller);

        $nama_lengkap = $reseller->nama_lengkap;
        $email = $reseller->email;
        $no_pesanan = $head_transaksi->no_pesanan;
        $total = $grand_total;
        $trigger = "pesanan_dikonfirmasi";

        //dd($token);

        Mail::to($email)->send(new SendEmailPesanan($nama_lengkap, $email, $no_pesanan, $total, $trigger));

        return redirect()->route('reseller.order.invoice', $head_transaksi->no_pesanan);
    }

    public function checkoutPJawa(Request $request)
    {
        $id_agen = Session::get('id_agen');
        $id_reseller = Session::get('id');
        $subtotal = 0;

        $cart = Cart::where('id_reseller', $id_reseller)->get();
        foreach($cart as $cart){
            $subtotal += $cart->subtotal;
        }

        $head_transaksi = new HeadTransaksi;
        $head_transaksi->no_pesanan = $request->no_pesanan;
        $head_transaksi->id_agen = $request->id_agen;
        $head_transaksi->id_reseller = $request->id_reseller;
        $head_transaksi->total_pembelian = $subtotal;
        $head_transaksi->ongkir = 0;
        $head_transaksi->grand_total = $subtotal;
        $head_transaksi->catatan = $request->catatan;
        $head_transaksi->tgl_pesan = $request->tgl_pesan;
        $head_transaksi->status = 'Menunggu pembayaran';
        $head_transaksi->save();
        
        // --------- INSERT DATA DETAIL TRANSAKSI ( TABEL DETAIL TRANSACTION ) -----------//
        $id_head = $head_transaksi->id;
        $detail_transaksi = DB::select(DB::raw("INSERT INTO detail_transaksi (id_produk, harga, qty, berat, subtotal, id_head) SELECT id_produk, harga, qty, berat,subtotal,'$id_head' FROM cart WHERE id_reseller='$id_reseller'"));
        
        $cart = Cart::where('id_reseller', $id_reseller)->get();

        // --------- INSERT TABLE PROFIT AGEN -----------//
        $total_harga_reseller = DB::table('cart')->where('id_reseller', $id_reseller)->sum('subtotal');
        $total_harga_agen = DB::table('cart')->where('id_reseller', $id_reseller)->sum('subtotal_harga_agen');
        
        $profit_agen = $total_harga_reseller - $total_harga_agen;

        $data_profit = Profit::where('id_agen', $head_transaksi->id_agen)->first();
        if($data_profit == null){
            $newProfit = new Profit;
            $newProfit->id_agen = $head_transaksi->id_agen;
            $newProfit->profit = $profit_agen;
            $newProfit->save();
        }elseif($data_profit->profit > 0){
            $newProfit = Profit::where('id_agen', $head_transaksi->id_agen)->first();

            $akumulasi_profit = $newProfit->profit + $profit_agen;

            $newProfit->profit = $akumulasi_profit;
            $newProfit->save();
        }elseif($data_profit->profit == 0){
            $newProfit = Profit::where('id_agen', $head_transaksi->id_agen)->first();
            $newProfit->profit = $profit_agen;
            $newProfit->save();
        }

        // --------- DELETE DATA CART ( TABEL CART ) -----------//
        $deleteCart = [];
        foreach($cart as $row){
            $deleteCart[] = Cart::where('id', $row->id)->delete();
        }

        $reseller = Reseller::find($id_reseller);

        $nama_lengkap = $reseller->nama_lengkap;
        $email = $reseller->email;
        $no_pesanan = $head_transaksi->no_pesanan;
        $total = $subtotal;
        $trigger = "pesanan_dikonfirmasi";

        //dd($token);

        Mail::to($email)->send(new SendEmailPesanan($nama_lengkap, $email, $no_pesanan, $total, $trigger));

        return redirect()->route('reseller.order.invoice', $head_transaksi->no_pesanan);
    }

    public function invoice($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        $id_reseller = $head_transaksi->id_reseller;
        $detail_reseller = DB::table('akun_reseller')
                        ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                        ->where('akun_reseller.id', $id_reseller)
                        ->first();

        $detail_transaksi = DetailTransaksi::with('produk')->get();

        return view('reseller.order.invoice', compact('head_transaksi','detail_transaksi','detail_reseller'));
    }

    public function payment($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        return view('reseller.order.bayar', compact('head_transaksi'));
    }

    public function confirmationPaymet($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        return view('reseller.order.konfirmasi-pembayaran', compact('head_transaksi'));
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

        return redirect()->route('reseller.order.berhasil-konfirmasi');
    }

    public function successConfirmation()
    {
        return view('reseller.order.selesai');
    }
}
