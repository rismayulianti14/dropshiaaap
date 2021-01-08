<?php

namespace App\Models\Transaksi;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_produk',
        'harga',
        'qty',
        'berat',
        'subtotal',
        'id_agen',
        'id_reseller',
        'subtotal_harga_agen'
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
