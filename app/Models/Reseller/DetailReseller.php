<?php

namespace App\Models\Reseller;
use App\Models\Reseller\Reseller;
use App\Models\Rajaongkir\Provinsi;
use App\Models\Rajaongkir\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailReseller extends Model
{
    use HasFactory;
    protected $table = 'detail_reseller';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'provinsi',
        'kota',
        'kecamatan',
        'kode_pos',
        'alamat_detail',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'id_reseller'
    ];

    public function reseller()
    {
        return $this->hasMany(Reseller::class, 'id_reseller', 'id_reseller');
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
