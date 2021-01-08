<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Kategori;
use App\Models\Pusat\FotoProduk;
use App\Models\Pusat\Jabodetabek;
use App\Models\Pusat\PulauJawa;
use App\Models\Pusat\LuarPulauJawa;
use App\Models\Transaksi\DetailTransaksi;
use App\Models\Transaksi\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'name_produk',
        'deskripsi',
        'berat',
        'stok',
        'id_kategori'
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function foto_produk()
    {
        return $this->hasOne(FotoProduk::class, 'id_produk');
    }

    public function jabodetabek()
    {
        return $this->belongsTo(Jabodetabek::class, 'id', 'id_produk');
    }

    public function pulau_jawa()
    {
        return $this->belongsTo(PulauJawa::class, 'id', 'id_produk');
    }

    public function luar_pulau_jawa()
    {
        return $this->belongsTo(LuarPulauJawa::class, 'id', 'id_produk');
    }

    public function detail_transaksi()
    {
        return $this->hasOne(DetailTransaksi::class, 'id', 'id_produk');
    }

    public function keranjang()
    {
        return $this->hasOne(Cart::class, 'id','id_produk');
    }
}
