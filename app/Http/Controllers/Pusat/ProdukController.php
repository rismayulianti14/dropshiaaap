<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Kategori;
use App\Models\Pusat\Produk;
use App\Models\Pusat\FotoProduk;
use App\Models\Pusat\Jabodetabek;
use App\Models\Pusat\PulauJawa;
use App\Models\Pusat\LuarPulauJawa;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Excel\ExportProduk;
use Excel;
use PDF;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        $foto_produk = FotoProduk::get();

        return view('pusat.produk.index', compact('data','foto_produk'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('pusat.produk.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:100',
            'id_kategori' => 'required',
            'deskripsi' => 'required',
            'berat' => 'required|numeric|gt:0',
            'stok' => 'required|numeric|gt:0',

            'harga_agen_jabodetabek' => 'required|numeric|gt:0',
            'harga_reseller_jabodetabek' => 'required|numeric|gt:0',

            'harga_agen_pjawa' => 'required|numeric|gt:0',
            'harga_reseller_pjawa' => 'required|numeric|gt:0',

            'harga_agen_lpjawa' => 'required|numeric|gt:0',
            'harga_reseller_lpjawa' => 'required|numeric|gt:0',

            'image' => 'required|max:2048',
        ]);

        $data = $request->all();

        $produk = new Produk;
        $produk->nama_produk = $data['nama_produk'];
        $produk->id_kategori = $data['id_kategori'];
        $produk->deskripsi = $data['deskripsi'];
        $produk->berat = $data['berat'];
        $produk->stok = $data['stok'];
        $produk->save();

        if($files = $request->file('image')){
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $file->move('uploads/produk', $name);
               
            $foto_produk = new FotoProduk; 
            $foto_produk->image = $name;
            $foto_produk->id_produk = $produk->id;
            $foto_produk->save();
            }
        }

        $jabodetabek = new Jabodetabek;
        $jabodetabek->harga_agen_jabodetabek = $data['harga_agen_jabodetabek'];
        $jabodetabek->harga_reseller_jabodetabek = $data['harga_reseller_jabodetabek'];
        $jabodetabek->id_produk = $produk->id;
        $jabodetabek->save();

        $pjawa = new PulauJawa;
        $pjawa->harga_agen_pjawa = $data['harga_agen_pjawa'];
        $pjawa->harga_reseller_pjawa = $data['harga_reseller_pjawa'];
        $pjawa->id_produk = $produk->id;
        $pjawa->save();

        $lpjawa = new LuarPulauJawa;
        $lpjawa->harga_agen_lpjawa = $data['harga_agen_lpjawa'];
        $lpjawa->harga_reseller_lpjawa = $data['harga_reseller_lpjawa'];
        $lpjawa->id_produk = $produk->id;
        $lpjawa->save();

        return redirect()->route('pusat.produk.index')->with(['success' => 'Data berhasil disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Produk::findOrFail($id);
        $kategori = Kategori::all();

        return view('pusat.produk.update', compact('data','kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:100',
            'id_kategori' => 'required',
            'deskripsi' => 'required',
            'berat' => 'required|numeric|gt:0',

            'harga_agen_jabodetabek' => 'required|numeric|gt:0',
            'harga_reseller_jabodetabek' => 'required|numeric|gt:0',

            'harga_agen_pjawa' => 'required|numeric|gt:0',
            'harga_reseller_pjawa' => 'required|numeric|gt:0',

            'harga_agen_lpjawa' => 'required|numeric|gt:0',
            'harga_reseller_lpjawa' => 'required|numeric|gt:0',
        ]);

        $data = $request->all();
        //dd($data);

        $produk = Produk::find($id);
        $produk->nama_produk = $data['nama_produk'];
        $produk->id_kategori = $data['id_kategori'];
        $produk->deskripsi = $data['deskripsi'];
        $produk->berat = $data['berat'];
        $produk->save();

        $jabodetabek = Jabodetabek::find($id);
        $jabodetabek->harga_agen_jabodetabek = $data['harga_agen_jabodetabek'];
        $jabodetabek->harga_reseller_jabodetabek = $data['harga_reseller_jabodetabek'];
        $jabodetabek->id_produk = $produk->id;
        $jabodetabek->save();

        $pjawa = PulauJawa::find($id);
        $pjawa->harga_agen_pjawa = $data['harga_agen_pjawa'];
        $pjawa->harga_reseller_pjawa = $data['harga_reseller_pjawa'];
        $pjawa->id_produk = $produk->id;
        $pjawa->save();

        $lpjawa = LuarPulauJawa::find($id);
        $lpjawa->harga_agen_lpjawa = $data['harga_agen_lpjawa'];
        $lpjawa->harga_reseller_lpjawa = $data['harga_reseller_lpjawa'];
        $lpjawa->id_produk = $produk->id;
        $lpjawa->save();

        return redirect()->route('pusat.produk.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function destroy($id)
    {
        $produk = Produk::find($id);
        $produk->delete($produk);

        $foto_produk = FotoProduk::find($id);
        $foto_produk->delete($foto_produk);

        $jabodetabek = Jabodetabek::find($id);
        $jabodetabek->delete($jabodetabek);

        $pjawa = PulauJawa::find($id);
        $pjawa->delete($pjawa);

        $lpjawa = LuarPulauJawa::find($id);
        $lpjawa->delete($lpjawa);

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }
    
    public function cek_stok($id)
    {
        $data = Produk::find($id);

        return response()->json([
            'data' => $data
        ]);
    }

    public function store_update_stok(Request $request)
    {
        $data = $request->all();
        $id = $data['id'];

        $produk = Produk::where('id', $id)->first();
        $produk->stok = $request->stok;
        $produk->save();

        return response()->json($produk);
    }

    public function detail_produk($id)
    {
        $data = Produk::where('id', $id)
                ->with('foto_produk')
                ->with('jabodetabek')
                ->with('pulau_jawa')
                ->with('luar_pulau_jawa')
                ->first();

        return response()->json([
            'data' => $data
        ]);
    }

    public function export_excel()
    {
        return Excel::download(new ExportProduk, 'produk.xlsx');
    }

    public function export_pdf()
    {
        $produk = Produk::all();
        $foto_produk = FotoProduk::get();

        $pdf = PDF::loadview('pusat.produk.pdf', compact('produk','foto_produk'));
        return $pdf->stream();
    }
}
