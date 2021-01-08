<?php

namespace App\Models\Agen;
use App\Models\Agen\EmailVerify;
use App\Models\Agen\DetailAgen;
use App\Models\Agen\ForgotPassword;
use App\Models\Transaksi\Profit;
use App\Models\Reseller\Reseller;
use App\Models\Transaksi\HeadTransaksi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agen extends Model
{
    use HasFactory;
    protected $table = 'akun_agen';
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
        'email_verify'
    ];

    public function email_verify()
    {
        return $this->belongsTo(EmailVerify::class, 'id', 'id');
    }

    public function detail_agen()
    {
        return $this->belongsTo(DetailAgen::class, 'id_agen', 'id');
    }

    public function forgot_password()
    {
        return $this->belongsTo(ForgotPassword::class, 'id', 'id');
    }

    public function head_transaksi()
    {
        return $this->hasOne(HeadTransaksi::class, 'id_agen');
    }

    public function reseller()
    {
        return $this->hasOne(Reseller::class, 'id');
    }

    public function profit()
    {
        return $this->hasOne(Profit::class, 'id');
    }
}
