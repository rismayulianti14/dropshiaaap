<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PulauJawa extends Model
{
    use HasFactory;
    protected $table = 'harga_pulau_jawa';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'harga_agen_pjawa',
        'harga_reseller_pjawa',
        'id_produk',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id');
    }
}
