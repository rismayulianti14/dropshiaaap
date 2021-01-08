<?php

namespace App\Models\Agen;
use App\Models\Agen\Agen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $table = 'forgot_password_agen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'token',
        'user_id',
        'status'
    ];

    public function agen()
    {
        return $this->hasMany(Agen::class, 'user_id', 'user_id');
    }
}
