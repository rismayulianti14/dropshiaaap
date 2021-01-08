<?php

namespace App\Models\Transaksi;
use App\Models\Transaksi\Alamat;
use App\Models\Agen\Agen;
use App\Models\Reseller\Reseller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadTransaksi extends Model
{
    use HasFactory;
    protected $table = 'head_transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'no_pesanan',
        'no_resi',
        'id_agen',
        'id_reseller',
        'nama',
        'telepon',
        'email',
        'id_alamat',
        'kurir',
        'ongkir',
        'total',
        'catatan',
        'tgl_pesan',
        'tgl_diterima',
        'tgl_tempo',
        'bukti_tf',
        'status',
    ];

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'id');
    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class, 'id');
    }

    public function alamat()
    {
        return $this->hasMany(Alamat::class, 'id_alamat', 'id_alamat');
    }

    public function detail_transaksi()
    {
        return $this->hasOne(DetailTransaksi::class, 'id');
    }
}
