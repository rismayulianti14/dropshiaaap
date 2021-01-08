<?php

namespace App\Models\Transaksi;
use App\Models\Agen\Agen;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profit extends Model
{
    use HasFactory;

    protected $table = 'profit_agen';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'id_agen',
        'profit'
    ];

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'id_agen');
    }
}
