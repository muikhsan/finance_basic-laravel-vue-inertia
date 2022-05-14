<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nominal_transaksi',
        'tanggal_transaksi',
        'deskripsi',
        'user_id',
        'jenis_transaksi',
        
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
