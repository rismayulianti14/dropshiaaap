<?php

namespace App\Http\Controllers\Pusat;
use App\Models\Pusat\Produk;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JabodetabekController extends Controller
{
    public function index()
    {
        $data = Produk::all();

        return view('pusat.jabodetabek.index', compact('data'));
    }
}
