<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PulauJawaController extends Controller
{
    public function index()
    {
        $data = Produk::all();

        return view('pusat.pulau jawa.index', compact('data'));
    }
}
