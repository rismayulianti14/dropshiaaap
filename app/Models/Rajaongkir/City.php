<?php

namespace App\Models\Rajaongkir;
use App\Models\Agen\DetailAgen;
use App\Models\Transaksi\Alamat;
use App\Models\Reseller\DetailReseller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function detail_agen()
    {
        return $this->belongsTo(DetailAgen::class, 'kota', 'city_id');
    }

    public function alamat()
    {
        return $this->hasOne(Alamat::class, 'city_id', 'id_kota');
    }

    public function detail_reseller()
    {
        return $this->hasOne(DetailReseller::class, 'city_id', 'id_kota');
    }
}
