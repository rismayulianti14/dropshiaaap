<?php

namespace App\Models\Reseller;
use App\Models\Agen\Agen;
use App\Models\Transaksi\HeadTransaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory;
    protected $table = 'akun_reseller';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode_id',
        'nama_lengkap',
        'username',
        'telepon',
        'email',
        'image',
        'password',
        'status',
        'email_verify',
        'id_agen',
    ];

    public function detail_reseller()
    {
        return $this->belongsTo(DetailReseller::class, 'id', 'id');
    }

    public function email_verify()
    {
        return $this->belongsTo(EmailVerify::class, 'id', 'id');
    }

    public function forgot_password()
    {
        return $this->belongsTo(ForgotPassword::class, 'id', 'id');
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'id_agen');
    }

    public function head_transaksi()
    {
        return $this->hasOne(HeadTransaksi::class, 'id_reseller');
    }
}
