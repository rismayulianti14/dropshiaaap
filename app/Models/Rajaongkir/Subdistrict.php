<?php

namespace App\Models\Rajaongkir;
use App\Models\Agen\DetailAgen;
use App\Models\Transaksi\Alamat;
use App\Models\Reseller\DetailReseller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subdistrict extends Model
{
    protected $guarded = [];

    public function detail_agen()
    {
        return $this->belongsTo(DetailAgen::class, 'kecamatan', 'subdistrict_id');
    }

    public function alamat()
    {
        return $this->hasOne(DetailAgen::class, 'subdistrict_id', 'kecamatan');
    }

    public function detail_reseller()
    {
        return $this->hasOne(DetailReseller::class, 'subdistrict_id', 'id_provinsi');
    }
}
