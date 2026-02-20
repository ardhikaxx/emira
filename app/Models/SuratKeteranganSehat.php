<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratKeteranganSehat extends Model
{
    protected $fillable = [
        'no_surat', 'kunjungan_id', 'pasien_id', 'dokter_id', 'keperluan', 'keterangan', 'tanggal_surat'
    ];

    protected function casts(): array
    {
        return ['tanggal_surat' => 'date'];
    }

    public function kunjungan(): BelongsTo
    {
        return $this->belongsTo(Kunjungan::class);
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}
