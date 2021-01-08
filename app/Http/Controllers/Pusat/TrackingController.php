<?php

namespace App\Http\Controllers\Pusat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TrackingController extends Controller
{
    public function index()
    {
        return view('pusat.tracking.lacak-pesanan');
    }

    public function lacak_paket($waybill, $courier)
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
            $tracks = [];

            if(!empty($object)){

                foreach ($object['manifest'] as $key => $field) {
                    array_push($tracks, [ 
                        "key" => $key+1,
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
