<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Produk;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $table = 'kategori';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kategori',
        'image'
    ];

    public function produk()
    {
        return $this->hasMany(Produk::class, 'id', 'id_kategori');
    }
}
