<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'tipe_pengajuan',
        'nominal',
        'tenor',
        'pendapatan_bulanan',
        'cicilan_per_bulan',
        'catatan',
        'status',
    ];

    protected $casts = [
        'nominal' => 'decimal:2',
        'pendapatan_bulanan' => 'decimal:2',
        'cicilan_per_bulan' => 'decimal:2',
    ];
}