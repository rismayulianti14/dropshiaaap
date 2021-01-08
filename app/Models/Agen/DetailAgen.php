<?php

namespace App\Models\Agen;
use App\Models\Agen\Agen;
use App\Models\Rajaongkir\Provinsi;
use App\Models\Rajaongkir\City;
use App\Models\Rajaongkir\Subdistrict;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailAgen extends Model
{
    use HasFactory;
    protected $table = 'detail_agen';
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
        'id_agen'
    ];

    public function agen()
    {
        return $this->hasMany(Agen::class, 'id', 'id_agen');
    }

    public function provinsi()
    {
        return $this->hasMany(Provinsi::class, 'province_id', 'provinsi');
    }

    public function kota()
    {
        return $this->hasMany(City::class, 'city_id', 'kota');
    }

    public function kecamatan()
    {
        return $this->hasMany(Subdistrict::class, 'subdistrict_id', 'kecamatan');
    }
}
