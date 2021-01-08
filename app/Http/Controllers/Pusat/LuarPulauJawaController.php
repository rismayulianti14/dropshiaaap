<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LuarPulauJawaController extends Controller
{
    public function index()
    {
        $data = Produk::all();

        return view('pusat.luar pulau jawa.index', compact('data'));
    }
}
