<?php

namespace App\Http\Controllers\Pusat\Reseller;
use App\Models\Reseller\Reseller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SemuaResellerController extends Controller
{
    public function index()
    {
        $reseller = Reseller::with('agen')->get();
        //dd($reseller);

        return view('pusat.reseller.semua-reseller', compact('reseller'));
    }

    public function show($id)
    {
        $data = DB::table('akun_reseller')
                ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                ->where('akun_reseller.id', $id)
                ->first();

        return response()->json([
            'data' => $data
        ]);
    }
}
