<?php

namespace App\Models\Pusat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $table = "forgot_password_pusat";
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
