<?php

namespace App\Http\Controllers\Pusat\Reseller;
use App\Models\Reseller\Reseller;
use App\Models\Agen\Agen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class KonfirmasiResellerController extends Controller
{
    public function index()
    {
        $reseller = Reseller::where('id_agen', 0)->get();
        //dd($reseller);

        return view('pusat.reseller.belum-dikonfirmasi', compact('reseller'));
    }

    public function confirmationAccount($id)
    {
        $detail_reseller = DB::table('akun_reseller')
                        ->join('detail_reseller', 'detail_reseller.id_reseller', '=', 'akun_reseller.id')
                        ->join('provinces', 'provinces.province_id', '=', 'detail_reseller.provinsi')
                        ->join('cities', 'cities.city_id', '=', 'detail_reseller.kota')
                        ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_reseller.kecamatan')
                        ->where('akun_reseller.id', $id)
                        ->first();

        $agen = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->get();

        $hananiya = DB::table('akun_agen')
                ->join('detail_agen', 'detail_agen.id_agen', '=', 'akun_agen.id')
                ->join('provinces', 'provinces.province_id', '=', 'detail_agen.provinsi')
                ->join('cities', 'cities.city_id', '=', 'detail_agen.kota')
                ->join('subdistricts', 'subdistricts.subdistrict_id', '=', 'detail_agen.kecamatan')
                ->where('akun_agen.id', 5)
                ->first();

        return view('pusat.reseller.konfirmasi', compact('detail_reseller', 'agen', 'hananiya'));
    }

    public function storeConfirmation(Request $request, $id_reseller)
    {
        $data = $request->all();
        $id_agen = $data['id_agen'];
        $id_reseller = $data['id_reseller'];
        
        $agen = Agen::where('id', $id_agen)->first();

        $reseller = Reseller::find($id_reseller);
        $reseller->id_agen = $agen->id;
        $reseller->status = 1;
        $reseller->save();
        //dd($reseller);

        return response()->json($reseller);
        
    }
}
