<?php

namespace App\Models\Transaksi;
use App\Models\Transaksi\HeadTransaksi;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'detail_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_produk',
        'harga',
        'qty',
        'berat',
        'subtotal',
        'id_head'
    ];

    public function head_transaksi()
    {
        return $this->belongsTo(HeadTransaksi::class, 'id_head');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id');
    }
}
