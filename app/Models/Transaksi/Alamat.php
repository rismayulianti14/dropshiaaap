<?php

namespace App\Models\Transaksi;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Rajaongkir\Provinsi;
use App\Models\Rajaongkir\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    use HasFactory;
    protected $table = 'alamat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_negara',
        'id_provinsi',
        'id_kota',
        'id_kecamatan',
        'alamat_detail'
    ];

    public function head_transaksi()
    {
        return $this->belongsTo(HeadTransaksi::class, 'id', 'id');
    }

    public function provinsi()
    {
        return $this->belongsTo(Provinsi::class, 'id_provinsi', 'city_id');
    }

    public function kota()
    {
        return $this->belongsTo(City::class, 'id_kota', 'city_id');
    }
}
