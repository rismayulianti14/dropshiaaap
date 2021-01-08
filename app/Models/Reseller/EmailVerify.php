<?php

namespace App\Models\Reseller;
use App\Models\Reseller\Reseller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerify extends Model
{
    use HasFactory;
    protected $table = 'email_verify_reseller';
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
