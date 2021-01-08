<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Petugas;
use App\Models\Pusat\EmailVerify;
use App\Http\Controllers\Controller;
use App\Mail\SendEMailPusat;
use App\Excel\ExportPetugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Excel;
use PDF;
use Session;

class PetugasController extends Controller
{
    public function index()
    {
        $data = Petugas::all();

        return view('pusat.petugas.index', compact('data'));
    }

    public function create()
    {
        /*--- ID PETUGAS ---*/
        $noUrutAkhir = Petugas::max('id');
        $no = 1;

        if($noUrutAkhir) {
            $no_awal = 'PS';
            $no_urut = sprintf("%03s", abs($noUrutAkhir + 1));
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }
        else {            
            $no_awal = 'PS';
            $no_urut = sprintf("%04s", $no);
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }

        return view('pusat.petugas.create', compact('kode_id'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|max:100',
            'username' => 'required|max:100',
            'email' => 'required|email|max:100|unique:akun_pusat',
            'telepon' => 'required|numeric|unique:akun_pusat',
            'posisi' => 'required',
            'password' => 'required|min:6|max:100|unique:akun_pusat',
            'image' => 'required'
        ]);

        /*--- ID PETUGAS ---*/
        $noUrutAkhir = Petugas::max('id');
        $no = 1;

        if($noUrutAkhir) {
            $no_awal = 'PS';
            $no_urut = sprintf("%03s", abs($noUrutAkhir + 1));
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }
        else {            
            $no_awal = 'PS';
            $no_urut = sprintf("%04s", $no);
            $tgl = date('md');
            $no_akhir = date('y');

            $kode_id = $no_awal . ' ' . $no_urut . ' ' . $tgl . ' ' . $no_akhir;
        }

        $petugas = new Petugas;
        $petugas->kode_id = $kode_id;
        $petugas->nama_lengkap = $request->nama_lengkap;
        $petugas->username = $request->username;
        $petugas->email = $request->email;
        $petugas->telepon = $request->telepon;
        $petugas->posisi = $request->posisi;
        $petugas->status = 1 ;
        $petugas->password = md5($request->password);
        $file       = $request->file('image');
            $fileName   = $file->getClientOriginalName();
            $request->file('image')->move("uploads/petugas/", $fileName);
        $petugas->image = $fileName;
        $petugas->email_verify = 0;
        $petugas->save();

        $tanggal = date('dmYhis');

        $email = new EmailVerify;
        $email->token = md5($tanggal);
        $email->user_id = $petugas->id;
        $email->status = 0;
        $email->save();

        $name = $request->nama_lengkap;
        $email = $request->email;
        $token = md5($tanggal);
        $trigger = "email_verify";

        Mail::to($email)->send(new SendEmailPusat($name, $email, $token, $trigger));

        return redirect()->route('pusat.petugas.index')->with(['success' => 'Data berhasil disimpan']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data = Petugas::find($id);

        return view('pusat.petugas.update', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $image_name = $request->hidden_image;
        $image = $request->file('image');
        if($image != '')
        {
            $request->validate([
                'nama_lengkap' => 'required|max:100',
                'username' => 'required|max:100',
                'telepon' => 'required|numeric',
                'posisi' => 'required',
                'image' => 'required'
            ]);

            $image_name = $image->getClientOriginalName();
            $image->move(public_path('uploads/petugas'), $image_name);
        }
        else
        {
            $request->validate([
                'nama_lengkap' => 'required|max:100',
                'username' => 'required|max:100',
                'telepon' => 'required|numeric',
                'posisi' => 'required'
            ]);
        }

        $form_data = array(
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'telepon' => $request->telepon,
            'posisi' => $request->posisi,
            'image' => $image_name
        );

        //dd($form_data);
        Petugas::whereId($id)->update($form_data);

        return redirect()->route('pusat.petugas.index')->with(['success' => 'Data berhasil diubah']);
    }

    public function destroy($id)
    {
        $data = Petugas::find($id);
        $data->delete($data);

        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }

    public function ubah_status(Request $request)
    {
        $petugas = Petugas::find($request->user_id);
        $petugas->status = $request->status;
        $petugas->save();
  
        return response()->json(['success'=>'Ubah status berhasil']);
    }

    public function export_excel()
    {
        return Excel::download(new ExportPetugas, 'petugas.xlsx');
    }

    public function export_pdf()
    {
        $data = Petugas::all();

        $pdf = PDF::loadview('pusat.petugas.pdf', compact('data'));
        return $pdf->stream();
    }
}
