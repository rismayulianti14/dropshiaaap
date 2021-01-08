<?php

namespace App\Models\Pusat;
use App\Models\Pusat\Petugas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
    use HasFactory;
    protected $table = "email_verify_pusat";
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'token',
        'user_id',
        'status'
    ];

    public function petugas()
    {
        return $this->hasMany(Petugas::class, 'user_id', 'user_id');
    }
}
