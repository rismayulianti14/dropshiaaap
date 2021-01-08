<?php

namespace App\Models\Pusat;
use App\Models\Pusat\EmailVerify;
use App\Models\Pusat\ForgotPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;
    protected $table = 'akun_pusat';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode_id',
        'nama_lengkap',
        'username',
        'email',
        'telepon',
        'posisi',
        'image',
        'password',
        'status',
        'email_verify'
    ];

    public function email_verify()
    {
        return $this->belongsTo(EmailVerify::class, 'id', 'id');
    }

    public function forgot_password()
    {
        return $this->belongsTo(ForgotPassword::class, 'id', 'id');
    }
}
