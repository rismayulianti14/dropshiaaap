<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotoProduk extends Model
{
    use HasFactory;
    protected $table = 'foto_produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'image',
        'id_produk',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id');
    }
}
