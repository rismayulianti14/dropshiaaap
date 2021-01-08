<?php

namespace App\Http\Controllers\Reseller\RiwayatPembelian;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Agen\Agen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Session;

class DikirimController extends Controller
{
    public function index()
    {
        $head_transaksi = HeadTransaksi::where('id_reseller', Session::get('id'))->where('status', 'Dikirim')->get();
        $detail_transaksi = DetailTransaksi::with('produk')->get();
        $count = count($head_transaksi);
        //dd($detail_transaksi);

        return view('reseller.riwayat pembelian.dikirim.index', compact('head_transaksi','count','detail_transaksi'));
    }

    public function OrdersAccepted($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('id_reseller', Session::get('id'))->where('no_pesanan', $no_pesanan)->first();
        $head_transaksi->tgl_diterima = date('Y-m-d');
        $head_transaksi->status = 'Diterima';
        $head_transaksi->save();
        //dd($head_transaksi);

        return redirect()->route('reseller.riwayat.diterima');
    }

    public function tracking($no_pesanan)
    {
        $head_transaksi = HeadTransaksi::where('no_pesanan', $no_pesanan)->first();

        return view('reseller.riwayat pembelian.dikirim.tracking', compact('head_transaksi'));
    }

    public function trackOrders($waybill, $courier)
    {
        $receipt_number = [];
        $seller = [];
        $buyer = [];
        $delivery_date = [];
        $track = [];
        $status = [];
        $success = [];
        $data = [];
        $error = [];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "waybill=$waybill&courier=$courier",
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
            $array = json_decode($response, true);
            $object = $array['rajaongkir']['result'];
            $tracks = []; // change this to tracks as you have an array

            if(!empty($object)){

                foreach ($object['manifest'] as $key => $field) {
                    array_push($tracks, [ // also change array name here
                        "date" => date('j M Y', strtotime($field['manifest_date'])) . ' ' . Carbon::parse($field['manifest_time'])->format('H:i'),
                        "desc" => $field['manifest_description'] . ' [' . $field['city_name'] . ']'
                    ]);
                };
                $data[] = $tracks;
            }
            //dd($tracks);
            return response()->json($tracks);
        }
    }
}
