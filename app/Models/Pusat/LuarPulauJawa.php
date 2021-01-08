<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LuarPulauJawa extends Model
{
    use HasFactory;
    protected $table = 'harga_luar_pulau_jawa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'harga_agen_lpjawa',
        'harga_reseller_lpjawa',
        'id_produk',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id');
    }
}
