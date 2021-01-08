<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabodetabek extends Model
{
    use HasFactory;
    protected $table = 'harga_jabodetabek';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'harga_agen_jabodetabek',
        'harga_reseller_jabodetabek',
        'id_produk',
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_produk', 'id');
    }
}
