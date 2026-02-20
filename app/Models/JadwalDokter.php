<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalDokter extends Model
{
    protected $fillable = ['dokter_id', 'poli_id', 'hari', 'jam_mulai', 'jam_selesai', 'kuota_pasien', 'is_active'];

    protected function casts(): array
    {
        return [
            'jam_mulai' => 'datetime:H:i',
            'jam_selesai' => 'datetime:H:i',
            'is_active' => 'boolean',
        ];
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }

    public function poli(): BelongsTo
    {
        return $this->belongsTo(Poli::class);
    }
}
