<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RawatInap extends Model
{
    protected $fillable = [
        'no_rawat_inap', 'kunjungan_id', 'pasien_id', 'dokter_id', 'ruangan_id',
        'no_tempat_tidur', 'tanggal_masuk', 'jam_masuk', 'tanggal_keluar', 'jam_keluar',
        'kondisi_masuk', 'kondisi_keluar', 'cara_keluar', 'status'
    ];

    protected function casts(): array
    {
        return [
            'tanggal_masuk' => 'date',
            'jam_masuk' => 'datetime:H:i',
            'tanggal_keluar' => 'date',
            'jam_keluar' => 'datetime:H:i',
        ];
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

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function perkembanganPasiens(): HasMany
    {
        return $this->hasMany(PerkembanganPasien::class);
    }
}
