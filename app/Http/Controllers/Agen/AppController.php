<?php

namespace App\Http\Controllers\Agen;
use App\Models\Agen\Agen;
use App\Models\Reseller\Reseller;
use App\Models\Transaksi\Profit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use DB;

class AppController extends Controller
{
    public function dashboard()
    {
        $profit = Profit::where('id_agen', Session::get('id'))->first();

        $reseller = Reseller::where('id_agen', Session::get('id'))->where('status', 1)->get();
        $reseller_aktif = count($reseller);

        $resellerr = Reseller::where('id_agen', Session::get('id'))->get();
        $total_reseller = count($resellerr);

        //dd($profit);
        return view('agen.dashboard', compact('profit','reseller_aktif','total_reseller','reseller'));
    }

    public function profil()
    {
        return view('agen.akun.profil');
    }

    public function ubah_foto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'image' => 'required',
        ]);

        $image = Session::get('image');

        $data = Agen::where('image', $image)->first();
        $file = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/agen/", $fileName);
        $data->image = $fileName;
        $data->save();

        return redirect()->route('agen.profil')->with(['success' => 'Foto profil berhasil diubah']);
    }

    public function get_profil($id)
    {
        $data = Agen::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function ubah_profil(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];
        
        $agen = Agen::where('id', $id)->first();
        $agen->nama_lengkap = $request->nama_lengkap;
        $agen->username = $request->username;
        $agen->telepon = $request->telepon;
        $agen->save();

        return response()->json($agen);
    }
}
