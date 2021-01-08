<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Excel\ExportKategori;
use Excel;
use PDF;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();

        return view('pusat.kategori.index', compact('data'));
    }

    public function create()
    {
        return view('pusat.kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kategori' => 'required|max:50',
            'image' => 'required|image|max:2048',
        ]);

        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/icon kategori/", $fileName);
        $kategori->image = $fileName;

        $kategori->save();
        //dd($kategori);

        return redirect()->route('pusat.kategori.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Kategori::findOrFail($id);

        return view('pusat.kategori.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'kategori' => 'required|max:50',
                'image'         =>  'image|max:2048'
            ]);

            $image_name = $image->getClientOriginalName();
            $image->move(public_path('uploads/icon kategori'), $image_name);
        }
        else
        {
            $request->validate([
                'kategori' => 'required|max:50',
            ]);
        }

        $form_data = array(
            'kategori'       =>   $request->kategori,
            'image'            =>   $image_name
        );

        //dd($form_data);
        Kategori::whereId($id)->update($form_data);

        return redirect()->route('pusat.kategori.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function destroy($id)
    {
        $data = Kategori::find($id);
        $data->delete($data);

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function export_excel()
    {
        return Excel::download(new ExportKategori, 'kategori.xlsx');
    }

    public function export_pdf()
    {
        $kategori = Kategori::all();

        $pdf = PDF::loadview('pusat.kategori.pdf', compact('kategori'));
        return $pdf->stream(); 
    }
}
