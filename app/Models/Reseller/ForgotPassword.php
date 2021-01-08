<?php

namespace App\Models\Reseller;
use App\Models\Reseller\Reseller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $table = 'forgot_password_reseller';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'token',
        'user_id',
        'status'
    ];

    public function reseller()
    {
        return $this->hasMany(Reseller::class, 'user_id', 'user_id');
    }
}
