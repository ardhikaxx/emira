<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TindakanKeperawatan extends Model
{
    protected $fillable = [
        'kunjungan_id', 'pasien_id', 'perawat_id', 'jenis_tindakan', 'deskripsi', 'waktu_tindakan', 'respons_pasien'
    ];

    protected function casts(): array
    {
        return ['waktu_tindakan' => 'datetime'];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function perawat(): BelongsTo
    {
        return $this->belongsTo(User::class, 'perawat_id');
    }
}
